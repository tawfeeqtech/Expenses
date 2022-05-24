<!-- Topbar Start -->
<div class="navbar-custom">
    <!-- LOGO -->
    <div class="logo-box">
        <a href="index.html" class="logo text-center logo-dark">
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="22">
                </span>
            <span class="logo-sm">
                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="24">
                </span>
        </a>

        <a href="index.html" class="logo text-center logo-light">
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="22">
                </span>
            <span class="logo-sm">
                    <img src="{{asset('assets/images/logo-sm-light.png')}}" alt="" height="24">
                </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
    </ul>
</div>
<!-- end Topbar -->




<div class="left-side-menu">
    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li>
{{--                    @if(request()->segment(1)==='countries')  @endif--}}
{{--                    {{ request()->is('*employees*') ? 'bg-secondary text-white' : '' }}--}}
                    <a href="/" class="@if(request()->segment(1)==='/') active @endif">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> لوحة التحكم </span>
                    </a>
                </li>

                <li>
                    <a href="/treatment">
                        <i class="mdi mdi-calendar-month"></i>
                        <span> المعاملات </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('wallets.index')}}" class="{{ request()->is('*wallets*') ? 'active' : '' }}">
                        <i class="mdi mdi-calendar-month"></i>
                        <span> المحفظات </span>
                    </a>
                </li>

                <li>
                    {{--<a href="javascript: void(0);">
                        <i class="mdi mdi-google-pages"></i>
                        <span> الاقسام </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('sections.tab1')}}">الدخل</a></li>
                        <li><a href="{{route('sections.tab2')}}">المصروف</a></li>
                    </ul>--}}


                    <a href="{{route('sections.index')}}" class="{{ request()->is('*sections*') ? 'active' : '' }}">
                        <i class="mdi mdi-content-copy"></i>
                        <span> الاقسام </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('contacts.index')}}" class="{{ request()->is('*contacts*') ? 'active' : '' }}">
                        <i class="mdi mdi-calendar-month"></i>
                        <span> جهات الاتصال </span>
                    </a>
                </li>

                <li style="text-decoration: line-through;">
                        <a href="javascript:void(0);">
                            <i class="mdi mdi-calendar-month"></i>
                            <span> الديون والاقساط </span>
                        </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->
</div>
