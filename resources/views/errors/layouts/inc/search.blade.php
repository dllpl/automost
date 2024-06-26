<?php
// Fix: 404 error page don't know language and country objects.
$countryCode = 'us'; /* @fixme - Issue only in multi-countries mode. Get the real default country. */
$searchUrl = \App\Helpers\UrlGen::searchWithoutQuery();
?>

<section class="search">
    <div class="search__container container">
        <a href="{{ \App\Helpers\UrlGen::searchWithoutQuery() }}" class="search__link link link--btn link--accent">{{ t('all_ads') }}</a>

        <form id="search" name="search" action="{{ \App\Helpers\UrlGen::searchWithoutQuery() }}" method="GET" class="search__form form-search">
            <input name="q" placeholder="{{ t('what') }}" type="text" value="" class="input-reset input input--search">
<input name="l" value="{{session()->has('l') ? session()->get('l') : ''}}" type="text" hidden>
            <button class="btn-reset form-search__btn">
                <span class="form-search__btn-text">{{ t('find') }}</span>
                <svg class="icon icon--search">
                    <use xlink:href="images/sprite.svg#search-white"></use>
                </svg>
            </button>
        </form>

        <a class="search__city link link--flex" href="#browseLocations" data-bs-toggle="modal" data-admin-code="0" data-city-id="0">
            <svg class="icon icon--geo">
                <use xlink:href="/images/sprite.svg#geo"></use>
            </svg>
            <span>{{ session()->has('location') ? session()->get('location') : t('choose_your_city') }}</span>
        </a>
    </div>
</section>


{{--<div class="p-0 mt-lg-4 mt-md-3 mt-3"></div>--}}
{{--<div class="container">--}}
{{--	--}}
{{--	<div class="intro only-search-bar">--}}
{{--		<div class="container text-center">--}}
{{--			--}}
{{--			<form id="search" name="search" action="{{ $searchUrl }}" method="GET">--}}
{{--				<div class="row search-row animated fadeInUp">--}}
{{--					--}}
{{--					<div class="col-md-5 col-sm-12 search-col relative mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">--}}
{{--						<div class="search-col-inner">--}}
{{--							<i class="fas {{ (config('lang.direction')=='rtl') ? 'fa-angle-double-left' : 'fa-angle-double-right' }} icon-append"></i>--}}
{{--							<div class="search-col-input">--}}
{{--								<input class="form-control has-icon" name="q" placeholder="{{ t('what') }}" type="text" value="">--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					--}}
{{--					<input type="hidden" id="lSearch" name="l" value="">--}}
{{--					--}}
{{--					<div class="col-md-5 col-sm-12 search-col relative locationicon mb-1 mb-xxl-0 mb-xl-0 mb-lg-0 mb-md-0">--}}
{{--						<div class="search-col-inner">--}}
{{--							<i class="fas fa-map-marker-alt icon-append"></i>--}}
{{--							<div class="search-col-input">--}}
{{--								<input class="form-control locinput input-rel searchtag-input has-icon"--}}
{{--									   id="locSearch"--}}
{{--									   name="location"--}}
{{--									   placeholder="{{ t('where') }}"--}}
{{--									   type="text"--}}
{{--									   value=""--}}
{{--								>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					--}}
{{--					<div class="col-md-2 col-sm-12 search-col">--}}
{{--						<div class="search-btn-border bg-primary">--}}
{{--							<button class="btn btn-primary btn-search btn-block btn-gradient">--}}
{{--								<i class="fas fa-search"></i> <strong>{{ t('find') }}</strong>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					--}}
{{--				</div>--}}
{{--			</form>--}}
{{--			--}}
{{--		</div>--}}
{{--	</div>--}}
{{--	--}}
{{--</div>--}}
