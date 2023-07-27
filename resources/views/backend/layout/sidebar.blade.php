<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('admin_dashboard')}}">
            <img src="{{ asset('front/images/logo.png') }}" alt="{{$site_name}}" class="img-fluid" width="132" height="132" />
            <!--<h3>DAMANFX</h3>-->
        </a>
        <ul class="sidebar-nav">
            <!--<li class="sidebar-header">
                Pages
            </li>-->

            <li class="sidebar-item {{ (request()->is('backend/dashboard') || request()->is('backend/inventory-report')) ? 'active' : '' }}">
                <a href="{{route('admin_dashboard')}}" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{ __('Dashboard') }}</span>
                    <!--<span class="badge badge-sidebar-primary">5</span>-->
                </a>
            </li>
            <li class="sidebar-item {{ (request()->is('backend/general-settings') || request()->is('backend/email-templates') || request()->is('backend/platform-charges*') || request()->is('backend/delete-all-data*'))? 'active' : '' }}">
                <a data-bs-target="#sidebar_settings" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">{{ __('Site Settings')}}</span>
                </a>
                <ul id="sidebar_settings" class="sidebar-dropdown list-unstyled collapse {{ (request()->is('backend/site-settings') || request()->is('backend/email-templates') || request()->is('backend/page*') || request()->is('backend/platform-charges*') || request()->is('backend/smtp*') || request()->is('backend/delete-all-data*'))  ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('backend/site-settings')) ? 'active' : '' }}"><a class="sidebar-link" href="{{route('admin_site-settings')}}">{{ __('General Settings')}}</a></li>
                    <li class="sidebar-item {{ (request()->is('backend/email-templates')) ? 'active' : '' }}"><a class="sidebar-link" href="{{route('admin_email-templates')}}">{{ __('Email Templates')}}</a></li>
                    <!--<li class="sidebar-item {{ (request()->is('backend/page*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_pages')}}">{{ __('Page')}}</a></li>-->
                    <li class="sidebar-item {{ (request()->is('backend/smtp*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_smtp')}}">{{ __('SMTP Mail Settings')}}</a></li>
                </ul>     
            </li>

            <li class="sidebar-item {{ (request()->is('backend/page*') || request()->is('backend/faq*'))? 'active' : '' }}">
                <a data-bs-target="#sidebar_pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">{{ __('Content Settings')}}</span>
                </a>
                <ul id="sidebar_pages" class="sidebar-dropdown list-unstyled collapse {{ (request()->is('backend/page*') || request()->is('backend/faq*'))  ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('backend/page*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_pages')}}">{{ __('Page')}}</a></li>
                </ul> 
            </li>
        </ul>
    </div>
</nav>
