<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">

        <img src="{{ asset('logo.jpg') }}" height="45" alt="Logo" class="mr-1">
              <span class="app-brand-text demo  menu-text fw-bold" style="font-size : 18px">Vision Therapy</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Main Section -->

        <li class="menu-header">@lang('general.Main')</li>

        <li class="menu-item  {{ Route::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link side-sclaex">
                <i class="menu-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M13.45 11.55l2.05 -2.05" />
                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                    </svg>
                </i>
                <div>@lang('general.Dashboard')</div>
            </a>
        </li>

        <!-- Management Section -->

        <li class="menu-header">@lang('general.Management')</li>
        <li class="menu-item {{ Route::is('admin.admins.*') ? 'active' : '' }}">
            <a href="{{ route('admin.admins.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div>{{__('general.Admins')}}</div>
            </a>
        </li>

        <!-- General Section -->
        <li class="menu-header">@lang('general.General')</li>


            <li class="menu-item {{ Route::is('admin.users.*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="menu-link side-sclaex">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div>{{__('general.patients')}}</div>
                </a>
            </li>

        <li class="menu-item {{ Route::is('admin.examinations.*') ? 'active' : '' }}">
            <a href="{{ route('admin.examinations.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-stethoscope"></i>
                <div>{{__('Examinations')}}</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('admin.inventories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.inventories.index') }}" class="menu-link side-sclaex">
                <i class="menu-icon tf-icons ti ti-box"></i>
                <div>{{__('Inventories')}}</div>
            </a>
        </li>

{{--        <li class="menu-item {{ Route::is('admin.subjects.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.subjects.index') }}" class="menu-link side-sclaex">--}}
{{--                <i class="menu-icon tf-icons ti ti-book"></i>--}}
{{--                <div>{{__('general.subjects')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <li class="menu-item {{ Route::is('admin.orders.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.orders.index') }}" class="menu-link side-sclaex">--}}
{{--                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>--}}
{{--                <div>{{__('general.orders')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}



{{--            <li class="menu-item {{ Route::is('admin.grades.*') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('admin.grades.index') }}" class="menu-link side-sclaex">--}}
{{--                    <i class="menu-icon tf-icons ti ti-schema"></i>--}}
{{--                    <div>{{__('general.grades')}}</div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu-item {{ Route::is('admin.study-types.*') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('admin.study-types.index') }}" class="menu-link side-sclaex">--}}
{{--                    <i class="menu-icon tf-icons ti ti-school"></i>--}}
{{--                    <div>{{__('general.Study Types')}}</div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="menu-item {{ Route::is('admin.semesters.*') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('admin.semesters.index') }}" class="menu-link side-sclaex">--}}
{{--                    <i class="menu-icon tf-icons ti ti-calendar"></i>--}}
{{--                    <div>{{__('general.semesters')}}</div>--}}
{{--                </a>--}}
{{--            </li>--}}


{{--            <li class="menu-item {{ Route::is('admin.payment-methods.*') ? 'active' : '' }}">--}}
{{--                <a href="{{ route('admin.payment-methods.index') }}" class="menu-link side-sclaex">--}}
{{--                    <i class="menu-icon tf-icons ti ti-credit-card"></i>--}}
{{--                    <div>{{__('general.Payment Methods')}}</div>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        <li class="menu-item {{ Route::is('admin.contact-us.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.contact-us.index') }}" class="menu-link side-sclaex">--}}
{{--                <i class="menu-icon tf-icons ti ti-mail"></i>--}}
{{--                <div>{{__('general.Contact Us')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="menu-item {{ Route::is('admin.faqs.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.faqs.index') }}" class="menu-link side-sclaex">--}}
{{--                <i class="menu-icon tf-icons ti ti-help"></i>--}}
{{--                <div>{{__('general.FAQs')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}


{{--        <li class="menu-item {{ Route::is('admin.notifications.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.notifications.index') }}" class="menu-link side-sclaex">--}}
{{--                <i class="menu-icon tf-icons ti ti-bell"></i>--}}
{{--                <div>{{__('general.Notifications')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}

        <!-- Settings Section -->
{{--        <li class="menu-header">@lang('general.Settings')</li>--}}
{{--        <li class="menu-item {{ Route::is('settings.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.settings.index') }}" class="menu-link side-sclaex">--}}
{{--                <i class="menu-icon tf-icons ti ti-settings"></i>--}}
{{--                <div>{{__('general.General Settings')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}


    </ul>

</aside>
<!-- / Menu -->
