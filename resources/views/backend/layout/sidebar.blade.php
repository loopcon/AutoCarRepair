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
                    <li class="sidebar-item {{ (request()->is('backend/faq*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_faq')}}">{{ __('FAQ')}}</a></li>
                </ul> 
            </li>

            <li class="sidebar-item {{ (request()->is('backend/car-brand*') || request()->is('backend/car-model*') || request()->is('backend/fuel-type*'))? 'active' : '' }}">
                <a data-bs-target="#sidebar_car_settings" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="command"></i> <span class="align-middle">{{ __('Basic')}}</span>
                </a>
                <ul id="sidebar_car_settings" class="sidebar-dropdown list-unstyled collapse {{ request()->is('backend/car-brand*') || request()->is('backend/car-model*') || request()->is('backend/fuel-type*') ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('backend/car-brand*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_car-brand')}}">{{ __('Car Brands')}}</a></li>
                    <li class="sidebar-item {{ (request()->is('backend/car-model*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_car-model')}}">{{ __('Car Models')}}</a></li>
                    <li class="sidebar-item {{ (request()->is('backend/fuel-type*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_fuel-type')}}">{{ __('Fuel Type')}}</a></li>
                </ul> 
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#sidebar_category" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="command"></i> <span class="align-middle">{{ __('Services')}}</span>
                </a>
                <ul id="sidebar_category" class="sidebar-dropdown list-unstyled collapse {{ request()->is('backend/service-category*') || request()->is('backend/scheduled-package*') ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('backend/service-category*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_service-category')}}">{{ __('Category')}}</a></li>
                    <li class="sidebar-item {{ (request()->is('backend/scheduled-package*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_scheduled-package')}}">{{ __('Scheduled Package')}}</a></li>
                </ul> 
            </li>

            <li class="sidebar-item {{ (request()->is('backend/shop-category*') || request()->is('backend/product*'))? 'active' : '' }}">
                <a data-bs-target="#sidebar_product" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="slack"></i> <span class="align-middle">{{ __('Product Details')}}</span>
                </a>
                <ul id="sidebar_product" class="sidebar-dropdown list-unstyled collapse {{ (request()->is('backend/shop-category*') || request()->is('backend/product*'))  ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('backend/shop-category*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_shop-category')}}">{{ __('Shop Category')}}</a></li>
                    <li class="sidebar-item {{ (request()->is('backend/product*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_products')}}">{{ __('Products')}}</a></li>
                </ul> 
            </li>

            <li class="sidebar-item {{ (request()->is('backend/enquiry')) ? 'active' : '' }}">
                <a href="{{route('admin_enquiry')}}" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{ __('Enquires') }}</span>
                    <!--<span class="badge badge-sidebar-primary">5</span>-->
                </a>
            </li>
             <li class="sidebar-item {{ (request()->is('backend/user')) ? 'active' : '' }}">
                <a href="{{route('admin_user')}}" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{ __('Users') }}</span>
                    <!--<span class="badge badge-sidebar-primary">5</span>-->
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#sidebar_content" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="command"></i> <span class="align-middle">{{ __('Home Page Settings')}}</span>
                </a>
                <ul id="sidebar_content" class="sidebar-dropdown list-unstyled collapse {{ request()->is('backend/home-page-content*') ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('backend/home-page-content*')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('admin_home-page-content')}}">{{ __('Content')}}</a></li>
                </ul> 
            </li>
        </ul>
    </div>
</nav>
