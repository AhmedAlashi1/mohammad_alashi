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
        <li class="menu-item {{ Route::is('admin.payments.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.payments.index') }}" class="menu-link side-sclaex">
                        <i class="menu-icon tf-icons ti ti-credit-card"></i>
                        <div>{{__('Payments')}}</div>
                    </a>
        </li>

{{--        <li class="menu-item {{ Route::is('admin.backup.*') ? 'active' : '' }}">--}}
{{--            <a href="{{ route('admin.backup.download') }}" class="menu-link"--}}
{{--               download="backup-latest.zip"--}}
{{--            >--}}
{{--                <i class="menu-icon tf-icons ti ti-database"></i>--}}
{{--                <div>{{__('Backup')}}</div>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        <a href="{{ route('admin.backup.create') }}" class="btn btn-primary">--}}
{{--            <i class="ti ti-database"></i> إنشاء نسخة احتياطية--}}
{{--        </a>--}}

{{--        <a href="{{ route('admin.backup.download') }}" class="btn btn-success">--}}
{{--            <i class="ti ti-download"></i> تحميل النسخة الأخيرة--}}
{{--        </a>--}}





    </ul>

</aside>
<!-- / Menu -->
