<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
        <p class="app-sidebar__user-name">John Doe</p>
        <p class="app-sidebar__user-designation">Frontend Developer</p>
    </div>
</div>
<ul class="app-menu">
    <li><a class="app-menu__item {{ Request::is('dashboard')?'active':'' }}" href="{{ route('dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item {{ Request::is('category*')?'active':'' }}" href="{{ route('category.index') }}"><i class="app-menu__icon fa fa-th-large"></i><span class="app-menu__label">Categories</span></a></li>
    <li><a class="app-menu__item {{ Request::is('service*')?'active':'' }}" href="{{ route('service.index') }}"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Services</span></a></li>
    <li><a class="app-menu__item {{ Request::is('service*')?'active':'' }}" href="{{ route('service.index') }}"><i class="app-menu__icon fa fa-spinner"></i><span class="app-menu__label">Services Request</span></a></li>
    <li><a class="app-menu__item {{ Request::is('team*')?'active':'' }}" href="{{ route('team.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Team</span></a></li>
    <li><a class="app-menu__item {{ Request::is('customers')?'active':''  }}" href="{{ route('customer') }}"><i class="app-menu__icon fa fa-user-o"></i><span class="app-menu__label">Customers</span></a></li>
    <li><a class="app-menu__item {{ Request::is('user*')?'active':''  }}" href="{{ route('user.index') }}"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Admins</span></a></li>


    <li class="treeview "><a class="app-menu__item {{ Request::is('setting*')?'active':'' }}" href=" " data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item {{ Request::is('setting/contact')?'active':'' }}" href="{{ route('user.index') }}"><i class="icon fa fa-circle-o"></i>Contact</a></li>
            <li><a class="treeview-item {{ Request::is('setting/log-links')?'active':'' }}" href="{{ route('user.index') }}"><i class="icon fa fa-circle-o"></i>Logo & Links</a></li>
            <li><a class="treeview-item {{ Request::is('setting/meta')?'active':'' }}" href="{{ route('user.index') }}"><i class="icon fa fa-circle-o"></i>Site Title & Meta tags</a></li>
            <li><a class="treeview-item {{ Request::is('setting/privacy')?'active':'' }}" href="{{ route('user.index') }}"><i class="icon fa fa-circle-o"></i>Privacy & Policy</a></li>
        </ul>
    </li>
</ul>
