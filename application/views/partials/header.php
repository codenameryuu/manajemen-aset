<header class="app-header">
    <a class="app-header__logo" href="<?php echo site_url('home'); ?>">
        Balai Besar Tekstil
    </a>

    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                <i class="fa fa-user fa-lg"></i>
            </a>

            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="<?php echo site_url('logout'); ?>">
                        <i class=" fa fa-sign-out fa-lg"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</header>