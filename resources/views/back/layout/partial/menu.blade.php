@php
    $user = Auth::user();
@endphp
<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i></a>
            <div class="navbar-brand">
                <center>
                    <a href="{{ URL::to('/') }}">
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="{{ URL::asset('public/back/assets/images/favicon.png') }}" alt="homepage" class="dark-logo" width="100%" style="max-width: 150px; margin-top: 10px;"  />
                            <!-- Light Logo icon -->
                            <img src="{{ URL::asset('public/back/assets/images/favicon.png') }}" alt="homepage" class="light-logo" width="100%" style="max-width: 150px; margin-top: 10px;" />
                        </b>
                    </a>
                </center>
            </div>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="javascript:void(0)">
                        <div class="customize-input"></div>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->gravatar }}" alt="user" class="rounded-circle" width="40">
                        <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span class="text-dark">{{ Auth::user()->name }}</span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ URL::to('logout') }}"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item <?php if($title == 'Dashboard'){ echo "selected"; } ?>"> 
                    <a class="sidebar-link sidebar-link" href="{{ URL::to('/') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if ($user->id_profile == '3')
                    <li class="sidebar-item <?php if($title == 'Antrian'){ echo "selected"; } ?>"> 
                        <a class="sidebar-link sidebar-link" href="{{ URL::to('antrian') }}" aria-expanded="false">
                            <i class="icon-earphones-alt"></i><span class="hide-menu">Antrian</span>
                        </a>
                    </li>
                @endif
                @if ($user->id_profile == '1' || $user->id_profile == '2')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow active" href="javascript:void(0)"
                        aria-expanded="false"><i class="icon-settings"></i>
                        <span class="hide-menu">Data Master </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line in">
                            @if ($user->id_profile == '1')
                                <li class="sidebar-item"><a href="{{ URL::to('instansi') }}" class="sidebar-link">
                                    <span class="hide-menu"> Instansi</span></a>
                                </li>
                            @endif
                            <li class="sidebar-item"><a href="{{ URL::to('loket') }}" class="sidebar-link">
                                <span class="hide-menu"> Loket</span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ URL::to('pelayanan') }}" class="sidebar-link">
                                <span class="hide-menu"> Pelayanan</span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($user->id_profile == '1' || $user->id_profile == '2')
                    <li class="sidebar-item <?php if($title == 'User'){ echo "selected"; } ?>"> 
                        <a class="sidebar-link sidebar-link" href="{{ URL::to('user') }}" aria-expanded="false">
                            <i class="icon-people"></i> <span class="hide-menu">User</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>