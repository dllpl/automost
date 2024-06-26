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

namespace App\Http\Controllers\Api\Post\CreateOrEdit;

use App\Helpers\Ip;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\City;
use App\Models\Package;
use App\Models\Post;

trait StoreTrait
{
	/**
	 * @param \App\Http\Requests\PostRequest $request
	 * @return array|\Illuminate\Http\JsonResponse|mixed
	 * @throws \Psr\Container\ContainerExceptionInterface
	 * @throws \Psr\Container\NotFoundExceptionInterface
	 */
	public function storePost(PostRequest $request)
	{
		// Get the Post's City
		$city = City::find($request->input('city_id', 0));
		if (empty($city)) {
			return $this->respondError(t('posting_listings_is_disabled'));
		}

		$user = null;
		if (auth('sanctum')->check()) {
			$user = auth('sanctum')->user();
		}

		// Conditions to Verify User's Email or Phone
		if (!empty($user)) {
			$emailVerificationRequired = config('settings.mail.email_verification') == '1'
				&& $request->filled('email')
				&& $request->input('email') != $user->email;
			$phoneVerificationRequired = config('settings.sms.phone_verification') == '1'
				&& $request->filled('phone')
				&& $request->input('phone') != $user->phone;
		} else {
			$emailVerificationRequired = config('settings.mail.email_verification') == '1' && $request->filled('email');
			$phoneVerificationRequired = config('settings.sms.phone_verification') == '1' && $request->filled('phone');
		}

		// New Post
		$post = new Post();
		$input = $request->only($post->getFillable());
		foreach ($input as $key => $value) {
			$post->{$key} = $value;
		}

		// Checkboxes
		$post->negotiable = $request->input('negotiable');
		$post->phone_hidden = $request->input('phone_hidden');

		// Other fields
		$post->country_code = $request->input('country_code', config('country.code'));
		$post->user_id = (isset($user) && isset($user->id)) ? $user->id : null;
        $post->lat = !empty($request->geo_lat) ? (double) $request->geo_lat : $city->latitude;
        $post->lon = !empty($request->geo_lon) ? (double) $request->geo_lon :  $city->longitude;
        $post->address = $request->full_address;
		$post->ip_addr = $request->input('ip_addr', Ip::get());
		$post->tmp_token = md5(microtime() . mt_rand(100000, 999999));
		$post->reviewed_at = null;

		if ($request->filled('email') || $request->filled('phone')) {
			$post->email_verified_at = now();
			$post->phone_verified_at = now();

			// Email verification key generation
			if ($emailVerificationRequired) {
				$post->email_token = md5(microtime() . mt_rand());
				$post->email_verified_at = null;
			}

			// Mobile activation key generation
			if ($phoneVerificationRequired) {
				$post->phone_token = mt_rand(100000, 999999);
				$post->phone_verified_at = null;
			}
		}

		if (
			config('settings.single.listings_review_activation') != '1'
			&& !$emailVerificationRequired
			&& !$phoneVerificationRequired
		) {
			$post->reviewed_at = now();
		}

		// Save
		$post->save();

		$data = [
			'success' => true,
			'message' => $this->apiMsg['post']['success'],
			'result'  => (new PostResource($post))->toArray($request),
		];

		$extra = [];

		// Save all pictures
		$extra['pictures'] = $this->storeSingleStepPictures($post->id, $request);

		// Custom Fields
		$this->storeFieldsValues($post, $request);

		// Auto-Register the Author
		$extra['autoRegisteredUser'] = $this->autoRegister($post, $request);


		// Make Payment (If needed)
		if (!isFromTheAppsWebEnvironment()) {
			// Check if the selected Package has been already paid for this Post
			$alreadyPaidPackage = false;
			if (!empty($post->latestPayment)) {
				if ($post->latestPayment->package_id == $request->input('package_id')) {
					$alreadyPaidPackage = true;
				}
			}

			// Check if Payment is required
			$package = Package::find($request->input('package_id'));
			if (!empty($package)) {
				if ($package->price > 0 && $request->filled('payment_method_id') && !$alreadyPaidPackage) {
					// Send the Payment
					// IMPORTANT: For REST API usage, payment plugins don't have to make redirection
					return $this->sendPayment($request, $post);
				}
			}
		}

		// If no payment is made (Continue)

		$data['success'] = true;
		$data['message'] = $this->apiMsg['post']['success'];

		// Send Verification Link or Code
		// Email
		if ($emailVerificationRequired) {
			// Send Verification Link by Email
			$extra['sendEmailVerification'] = $this->sendEmailVerification($post);
			if (
				array_key_exists('success', $extra['sendEmailVerification'])
				&& array_key_exists('message', $extra['sendEmailVerification'])
			) {
				$extra['mail']['success'] = $extra['sendEmailVerification']['success'];
				$extra['mail']['message'] = $extra['sendEmailVerification']['message'];
			}
		}

		// Phone
		if ($phoneVerificationRequired) {
			// Send Verification Code by SMS
			$extra['sendPhoneVerification'] = $this->sendPhoneVerification($post);
			if (
				array_key_exists('success', $extra['sendPhoneVerification'])
				&& array_key_exists('message', $extra['sendPhoneVerification'])
			) {
				$extra['mail']['success'] = $extra['sendPhoneVerification']['success'];
				$extra['mail']['message'] = $extra['sendPhoneVerification']['message'];
			}
		}

		// Once Verification Notification is sent (containing Link or Code),
		// Send Confirmation Notification, when user clicks on the Verification Link or enters the Verification Code.
		// Done in the "app/Observers/PostObserver.php" file.

		$data['extra'] = $extra;

		return $this->apiResponse($data);
	}
}
