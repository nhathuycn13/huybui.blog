<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>H</b>B</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Huy</b> Blog</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(auth()->user()->thumbnail)<img src="{{ auth()->user()->thumbnail }}" class="user-image" alt="User Image">@endif
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        @if(auth()->user()->thumbnail)
                        <li class="user-header">
                            <img src="{{ auth()->user()->thumbnail }}" class="img-circle" alt="User Image">

                            <p>
                                {{ auth()->user()->name }}

                            </p>
                        </li>
                        @endif
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('getConfigPersonal') }}" class="btn btn-default btn-flat">Thông Tin</a>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('postLogout') }}" method="post">
                                    {{ csrf_field() }}
                                    <button class="btn btn-default btn-flat">Đăng Xuất</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>