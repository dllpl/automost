<?php
// Search parameters
$queryString = (request()->getQueryString() ? ('?' . request()->getQueryString()) : '');

// Check if the Multi-Countries selection is enabled
$multiCountriesIsEnabled = false;
$multiCountriesLabel = '';

// Logo Label
$logoLabel = '';
if (request()->segment(1) != 'countries') {
	if ($multiCountriesIsEnabled) {
		$logoLabel = config('settings.app.name') . ((!empty(config('country.name'))) ? ' ' . config('country.name') : '');
	}
}
?>

<header class="header">
	<div class="header__container container-fluid">
		<a href="{{ url('/') }}">
			<img src="{{ config('settings.app.logo_url') }}"
				 alt="{{ strtolower(config('settings.app.name')) }}" class="main-logo" data-bs-placement="bottom"
				 data-bs-toggle="tooltip"
				 title="{!! $logoLabel !!}" style="height: 40px"/>
		</a>

		<button class="burger btn-reset" aria-label="{{t('open_mobile_menu')}}" aria-expanded="false" data-burger>
		  <span class="burger__icon">
			<span class="line"></span>
			<span class="line"></span>
			<span class="line"></span>
		  </span>
		</button>

		<div class="header__menu menu" data-menu>
			<ul class="list-reset header__list">
				@if (!auth()->check())
					<li class="header__item dropdown no-arrow open-on-hover">
						<a href="#" class="link link--flex dropdown-toggle" data-bs-toggle="dropdown">
							<svg class="header__svg">
								<use xlink:href="/images/sprite.svg#user"></use>
							</svg>
							<span class="header__content-adaptive">Вход и регистрация</span>
						</a>
						<ul id="authDropdownMenu" class="dropdown-menu user-menu shadow-sm">
							<li class="dropdown-item">
								@if (config('settings.security.login_open_in_modal'))
									<a href="#quickLogin" class="link" data-bs-toggle="modal"><i class="fas fa-user"></i> {{ t('log_in') }}</a>
								@else
									<a href="{{ \App\Helpers\UrlGen::login() }}" class="link"><i class="fas fa-user"></i> {{ t('log_in') }}</a>
								@endif
							</li>
							<li class="dropdown-item">
								<a href="{{ \App\Helpers\UrlGen::register() }}" class="link"><i class="far fa-user"></i> {{ t('sign_up') }}</a>
							</li>
						</ul>
					</li>
					{{--					<li class="header__item d-md-none d-sm-block d-block">--}}
					{{--						@if (config('settings.security.login_open_in_modal'))--}}
					{{--							<a href="#quickLogin" class="link" data-bs-toggle="modal"><i class="fas fa-user"></i> {{ t('log_in') }}</a>--}}
					{{--						@else--}}
					{{--							<a href="{{ \App\Helpers\UrlGen::login() }}" class="link"><i class="fas fa-user"></i> {{ t('log_in') }}</a>--}}
					{{--						@endif--}}
					{{--					</li>--}}
					{{--					<li class="header__item d-md-none d-sm-block d-block">--}}
					{{--						<a href="{{ \App\Helpers\UrlGen::register() }}" class="nav-link"><i class="far fa-user"></i> {{ t('sign_up') }}</a>--}}
					{{--					</li>--}}
				@else
					<li class="header__item">
						<a href="/account/posts/favourite" class="link">
							<svg class="header__svg">
								<use xlink:href="/images/sprite.svg#heart"></use>
							</svg>
							<span class="header__content-adaptive">Избранное</span>
						</a>
					</li>
					<li class="header__item">
						<a href="/account/saved-searches" class=" link">
							<svg class="header__svg">
								<use xlink:href="/images/sprite.svg#bell"></use>
							</svg>
							<span class="header__content-adaptive">Уведомления</span>
						</a>
					</li>
					<li class="header__item">
						<a href="/account/messages" class="link">
							<svg class="header__svg">
								<use xlink:href="/images/sprite.svg#chat"></use>
							</svg>
							<span class="header__content-adaptive">Чат</span>
						</a>
					</li>

					<li class="header__item dropdown no-arrow open-on-hover">
						<a href="#" class="dropdown-toggle link" data-bs-toggle="dropdown">
							<svg class="header__svg">
								<use xlink:href="/images/sprite.svg#user"></use>
							</svg>
							<span>{{ auth()->user()->name }}</span>
						</a>
						<ul id="userMenuDropdown" class="dropdown-menu user-menu shadow-sm">
							@if (isset($userMenu) && !empty($userMenu))
								@php
									$menuGroup = '';
                                    $dividerNeeded = false;
								@endphp
								@foreach($userMenu as $key => $value)
									@continue(!$value['inDropdown'])
									@php
										if ($menuGroup != $value['group']) {
                                            $menuGroup = $value['group'];
                                            if (!empty($menuGroup) && !$loop->first) {
                                                $dividerNeeded = true;
                                            }
                                        } else {
                                            $dividerNeeded = false;
                                        }
									@endphp
									@if ($dividerNeeded)
										<li class="dropdown-divider"></li>
									@endif
									<li class="dropdown-item{{ (isset($value['isActive']) && $value['isActive']) ? ' active' : '' }}">
										<a href="{{ $value['url'] }}">
											<i class="{{ $value['icon'] }}"></i> {{ $value['name'] }}
											@if (isset($value['countVar'], $value['countCustomClass']) && !empty($value['countVar']) && !empty($value['countCustomClass']))
												<span class="badge badge-pill badge-important{{ $value['countCustomClass'] }}">0</span>
											@endif
										</a>
									</li>
								@endforeach
							@endif
						</ul>
					</li>
				@endif

				@if (config('plugins.currencyexchange.installed'))
					@include('currencyexchange::select-currency')
				@endif

				@if (config('settings.single.pricing_page_enabled') == '2')
					<li class="header__item pricing">
						<a href="{{ \App\Helpers\UrlGen::pricing() }}" class="nav-link">
							<i class="fas fa-tags"></i> {{ t('pricing_label') }}
						</a>
					</li>
				@endif

				<?php
				$addListingUrl = \App\Helpers\UrlGen::addPost();
				$addListingAttr = '';
				if (!auth()->check()) {
					if (config('settings.single.guests_can_post_listings') != '1') {
						$addListingUrl = '#quickLogin';
						$addListingAttr = ' data-bs-toggle="modal"';
					}
				}
				if (config('settings.single.pricing_page_enabled') == '1') {
					$addListingUrl = \App\Helpers\UrlGen::pricing();
					$addListingAttr = '';
				}
				?>
				<li class="header__item postadd">
					<a class="link link--btn link--dark" href="{{ $addListingUrl }}"{!! $addListingAttr !!} style="color: white">
						{{ t('Create Listing') }}
					</a>
				</li>

				{{--				<li class="header__item d-md-none d-sm-block d-block">--}}
				{{--					<a href="{{ \App\Helpers\UrlGen::register() }}" class="nav-link"><i class="far fa-user"></i> {{ t('sign_up') }}</a>--}}
				{{--				</li>--}}
{{--				@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.menu.select-language', 'layouts.inc.menu.select-language'])--}}
			</ul>
		</div>
	</div>
</header>

{{--<div class="header">--}}
{{--	<nav class="navbar fixed-top navbar-site navbar-light bg-light navbar-expand-md" role="navigation">--}}
{{--		<div class="container">--}}

{{--			<div class="navbar-identity p-sm-0">--}}
{{--				--}}{{-- Logo --}}
{{--				<a href="{{ url('/') }}" class="navbar-brand logo logo-title">--}}
{{--					<img src="{{ config('settings.app.logo_url') }}" class="main-logo" style="height: 40px;"/>--}}
{{--				</a>--}}
{{--				--}}{{-- Toggle Nav (Mobile) --}}
{{--				<button class="navbar-toggler -toggler float-end"--}}
{{--						type="button"--}}
{{--						data-bs-toggle="collapse"--}}
{{--						data-bs-target="#navbarsDefault"--}}
{{--						aria-controls="navbarsDefault"--}}
{{--						aria-expanded="false"--}}
{{--						aria-label="Toggle navigation"--}}
{{--				>--}}
{{--					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="false">--}}
{{--						<title>{{ t('Menu') }}</title>--}}
{{--						<path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>--}}
{{--					</svg>--}}
{{--				</button>--}}
{{--				--}}{{-- Country Flag (Mobile) --}}
{{--				@if (request()->segment(1) != 'countries')--}}
{{--					@if ($multiCountriesIsEnabled)--}}
{{--						@if (!empty(config('country.icode')))--}}
{{--							@if (file_exists(public_path() . '/images/flags/24/' . config('country.icode') . '.png'))--}}
{{--								<button class="flag-menu country-flag d-md-none d-sm-block d-none btn btn-default float-end" href="#selectCountry" data-bs-toggle="modal">--}}
{{--									<img src="{{ url('images/flags/24/'.config('country.icode').'.png') . getPictureVersion() }}"--}}
{{--										 alt="{{ config('country.name') }}"--}}
{{--										 style="float: left;"--}}
{{--									>--}}
{{--									<span class="caret d-none"></span>--}}
{{--								</button>--}}
{{--							@endif--}}
{{--						@endif--}}
{{--					@endif--}}
{{--				@endif--}}
{{--			</div>--}}

{{--			<div class="navbar-collapse collapse" id="navbarsDefault">--}}
{{--				<ul class="nav navbar-nav me-md-auto navbar-left">--}}
{{--					--}}{{-- Country Flag --}}
{{--					@if (request()->segment(1) != 'countries')--}}
{{--						@if (config('settings.geo_location.show_country_flag'))--}}
{{--							@if (!empty(config('country.icode')))--}}
{{--								@if (file_exists(public_path() . '/images/flags/32/' . config('country.icode') . '.png'))--}}
{{--									<li class="flag-menu country-flag d-md-block d-sm-none d-none nav-item"--}}
{{--										data-bs-toggle="tooltip"--}}
{{--										data-bs-placement="{{ (config('lang.direction') == 'rtl') ? 'bottom' : 'right' }}"--}}
{{--									>--}}
{{--										@if ($multiCountriesIsEnabled)--}}
{{--											<a class="nav-link p-0" data-bs-toggle="modal" data-bs-target="#selectCountry">--}}
{{--												<img class="flag-icon"--}}
{{--													 src="{{ url('images/flags/32/' . config('country.icode') . '.png') . getPictureVersion() }}"--}}
{{--													 alt="{{ config('country.name') }}"--}}
{{--												>--}}
{{--												<span class="caret d-lg-block d-md-none d-sm-none d-none float-end mt-3 mx-1"></span>--}}
{{--											</a>--}}
{{--										@else--}}
{{--											<a class="p-0" style="cursor: default;">--}}
{{--												<img class="flag-icon"--}}
{{--													 src="{{ url('images/flags/32/' . config('country.icode') . '.png') . getPictureVersion() }}"--}}
{{--													 alt="{{ config('country.name') }}"--}}
{{--												>--}}
{{--											</a>--}}
{{--										@endif--}}
{{--									</li>--}}
{{--								@endif--}}
{{--							@endif--}}
{{--						@endif--}}
{{--					@endif--}}
{{--				</ul>--}}

{{--				<ul class="nav navbar-nav ms-auto navbar-right">--}}
{{--					@if (config('settings.list.display_browse_listings_link'))--}}
{{--						<li class="nav-item d-lg-block d-md-none d-sm-block d-block">--}}
{{--							@php--}}
{{--								$currDisplay = config('settings.list.display_mode');--}}
{{--								$browseListingsIconClass = 'fas fa-th-large';--}}
{{--								if ($currDisplay == 'make-list') {--}}
{{--									$browseListingsIconClass = 'fas fa-th-list';--}}
{{--								}--}}
{{--								if ($currDisplay == 'make-compact') {--}}
{{--									$browseListingsIconClass = 'fas fa-bars';--}}
{{--								}--}}
{{--							@endphp--}}
{{--							<a href="{{ \App\Helpers\UrlGen::searchWithoutQuery() }}" class="nav-link">--}}
{{--								<i class="{{ $browseListingsIconClass }}"></i> {{ t('Browse Listings') }}--}}
{{--							</a>--}}
{{--						</li>--}}
{{--					@endif--}}

{{--					<li class="nav-item dropdown no-arrow open-on-hover d-md-block d-sm-none d-none">--}}
{{--						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">--}}
{{--							<i class="fas fa-user"></i>--}}
{{--							<span>{{ t('log_in') }}</span>--}}
{{--							<i class="fas fa-chevron-down"></i>--}}
{{--						</a>--}}
{{--						<ul id="authDropdownMenu" class="dropdown-menu user-menu shadow-sm">--}}
{{--							<li class="dropdown-item">--}}
{{--								<a href="{{ \App\Helpers\UrlGen::login() }}" class="nav-link"><i class="fas fa-user"></i> {{ t('log_in') }}</a>--}}
{{--							</li>--}}
{{--							<li class="dropdown-item">--}}
{{--								<a href="{{ \App\Helpers\UrlGen::register() }}" class="nav-link"><i class="far fa-user"></i> {{ t('sign_up') }}</a>--}}
{{--							</li>--}}
{{--						</ul>--}}
{{--					</li>--}}
{{--					<li class="nav-item d-md-none d-sm-block d-block">--}}
{{--						<a href="{{ \App\Helpers\UrlGen::login() }}" class="nav-link"><i class="fas fa-user"></i> {{ t('log_in') }}</a>--}}
{{--					</li>--}}
{{--					<li class="nav-item d-md-none d-sm-block d-block">--}}
{{--						<a href="{{ \App\Helpers\UrlGen::register() }}" class="nav-link"><i class="far fa-user"></i> {{ t('sign_up') }}</a>--}}
{{--					</li>--}}

{{--					@if (config('settings.single.pricing_page_enabled') == '2')--}}
{{--						<li class="nav-item pricing">--}}
{{--							<a href="{{ \App\Helpers\UrlGen::pricing() }}" class="nav-link">--}}
{{--								<i class="fas fa-tags"></i> {{ t('pricing_label') }}--}}
{{--							</a>--}}
{{--						</li>--}}
{{--					@endif--}}

{{--					<li class="nav-item postadd">--}}
{{--						@if (config('settings.single.guests_can_post_listings') != '1')--}}
{{--							<a class="btn btn-block btn-border btn-post btn-listing" href="#quickLogin" data-bs-toggle="modal">--}}
{{--								<i class="far fa-edit"></i> {{ t('Create Listing') }}--}}
{{--							</a>--}}
{{--						@else--}}
{{--							<a class="btn btn-block btn-border btn-post btn-listing" href="{{ \App\Helpers\UrlGen::addPost(true) }}">--}}
{{--								<i class="far fa-edit"></i> {{ t('Create Listing') }}--}}
{{--							</a>--}}
{{--						@endif--}}
{{--					</li>--}}

{{--					@if (!empty(config('lang.abbr')))--}}
{{--						@includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.menu.select-language', 'layouts.inc.menu.select-language'])--}}
{{--					@endif--}}
{{--				</ul>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</nav>--}}
{{--</div>--}}