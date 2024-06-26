<?php
/*
 * LaraClassifier - Classified Ads Web Application
 * Copyright (c) BeDigit. All Rights Reserved
 *
 * Website: https://laraclassifier.com
 * Author: BeDigit | https://bedigit.com
 *
 * LICENSE
 * -------
 * This software is furnished under a license and may be used and copied
 * only in accordance with the terms of such license and with the inclusion
 * of the above copyright notice. If you Purchased from CodeCanyon,
 * Please read the full License from here - https://codecanyon.net/licenses/standard
 */

namespace App\Http\Controllers\Api\Post\CreateOrEdit\MultiSteps;

use App\Helpers\Ip;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\City;
use App\Models\Post;
use App\Models\Scopes\ReviewedScope;
use App\Models\Scopes\VerifiedScope;

trait UpdateMultiStepsFormTrait
{
	/**
	 * @param $id
	 * @param \App\Http\Requests\PostRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function updateMultiStepsForm($id, PostRequest $request)
	{
		$countryCode = $request->input('country_code', config('country.code'));

		$user = null;
		if (auth('sanctum')->check()) {
			$user = auth('sanctum')->user();
		}

		$post = null;
		if (!empty($user)) {
			$post = Post::countryOf($countryCode)->withoutGlobalScopes([VerifiedScope::class, ReviewedScope::class])
				->where('user_id', $user->id)
				->where('id', $id)
				->first();
		}

		if (empty($post)) {
			return $this->respondNotFound(t('post_not_found'));
		}

		// Get the Post's City
		$city = City::find($request->input('city_id', 0));
		if (empty($city)) {
			return $this->respondError(t('posting_listings_is_disabled'));
		}

		// Conditions to Verify User's Email or Phone
		$emailVerificationRequired = config('settings.mail.email_verification') == '1'
			&& $request->filled('email')
			&& $request->input('email') != $post->email;
		$phoneVerificationRequired = config('settings.sms.phone_verification') == '1'
			&& $request->filled('phone')
			&& $request->input('phone') != $post->phone;

		/*
		 * Allow admin users to approve the changes,
		 * If listings approbation option is enable,
		 * And if important data have been changed.
		 */
		if (config('settings.single.listings_review_activation')) {
			if (
				md5($post->title) != md5($request->input('title'))
				|| md5($post->description) != md5($request->input('description'))
			) {
				$post->reviewed_at = null;
			}
		}

		// Update Post
		$input = $request->only($post->getFillable());
		foreach ($input as $key => $value) {
			$post->{$key} = $value;
		}

		// Checkboxes
		$post->negotiable = $request->input('negotiable');
		$post->phone_hidden = $request->input('phone_hidden');

		// Other fields
        $post->lat = !empty($request->geo_lat) ? (double) $request->geo_lat : $city->latitude;
        $post->lon = !empty($request->geo_lon) ? (double) $request->geo_lon :  $city->longitude;
        $post->address = $request->full_address;
		$post->ip_addr = $request->input('ip_addr', Ip::get());

		// Email verification key generation
		if ($emailVerificationRequired) {
			$post->email_token = md5(microtime() . mt_rand());
			$post->email_verified_at = null;
		}

		// Phone verification key generation
		if ($phoneVerificationRequired) {
			$post->phone_token = mt_rand(100000, 999999);
			$post->phone_verified_at = null;
		}

		// Save
		$post->save();

		$data = [
			'success' => true,
			'message' => t('your_listing_has_been_updated'),
			'result'  => (new PostResource($post))->toArray($request),
		];

		$extra = [];

		// Custom Fields
		$this->storeFieldsValues($post, $request);

		// Send Email Verification message
		if ($emailVerificationRequired) {
			$extra['sendEmailVerification'] = $this->sendEmailVerification($post);
			if (
				array_key_exists('success', $extra['sendEmailVerification'])
				&& array_key_exists('message', $extra['sendEmailVerification'])
			) {
				$extra['mail']['success'] = $extra['sendEmailVerification']['success'];
				$extra['mail']['message'] = $extra['sendEmailVerification']['message'];
			}
		}

		// Send Phone Verification message
		if ($phoneVerificationRequired) {
			$extra['sendPhoneVerification'] = $this->sendPhoneVerification($post);
			if (
				array_key_exists('success', $extra['sendPhoneVerification'])
				&& array_key_exists('message', $extra['sendPhoneVerification'])
			) {
				$extra['mail']['success'] = $extra['sendPhoneVerification']['success'];
				$extra['mail']['message'] = $extra['sendPhoneVerification']['message'];
			}
		}

		$data['extra'] = $extra;

		return $this->apiResponse($data);
	}
}
