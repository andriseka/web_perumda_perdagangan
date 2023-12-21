<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                    aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        New Notifications
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                    data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                    aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                            New Messages
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/avatars/avatar-2.jpg') }}" class="avatar img-fluid rounded-circle" style="width: 30px; height: 30px" alt="Administrator" />
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/avatars/avatar-2.jpg') }}" class="avatar img-fluid rounded-circle me-1"
                        alt="Administrator" /> <span class="text-dark">Administrator</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.html">
                        <i class="align-middle me-1"data-feather="user"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="align-middle me-1" data-feather="help-circle"></i>
                        Help Center
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
