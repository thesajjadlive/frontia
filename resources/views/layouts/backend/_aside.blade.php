<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="max-width: 48px; max-height: 48px;" src="{{ asset(Auth::user()->image != null? Auth::user()->image : 'uploads/user_default.jpg') }}" alt="User Image">
    <div>
        <p class="app-sidebar__user-name" ><a style="color: white" class="text-decoration-none" href="{{ route('user.info') }}">{{ ucfirst(auth()->user()->name) ?? 'N/A' }}</a></p>
        <p class="app-sidebar__user-designation">{{ ucfirst(auth()->user()->type) ?? 'N/A' }}</p>
    </div>
</div>
<ul class="app-menu">
    <li><a class="app-menu__item {{ Request::is('dashboard')?'active':'' }}" href="{{ route('dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item {{ Request::is('category*')?'active':'' }}" href="{{ route('category.index') }}"><i class="app-menu__icon fa fa-th-large"></i><span class="app-menu__label">Categories</span></a></li>
    <li><a class="app-menu__item {{ Request::is('service*')?'active':'' }}" href="{{ route('service.index') }}"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Services</span></a></li>
    <li><a class="app-menu__item {{ Request::is('callback*')?'active':'' }}" href="{{ route('callback') }}"><i class="app-menu__icon fa fa-reply"></i><span class="app-menu__label">Callback Request</span></a></li>
    <li><a class="app-menu__item {{ Request::is('pending*')?'active':'' }}" href="{{ route('pending') }}"><i class="app-menu__icon fa fa-spinner"></i><span class="app-menu__label">Pending Request</span></a></li>
    <li><a class="app-menu__item {{ Request::is('request*')?'active':'' }}" href="{{ route('request.index') }}"><i class="app-menu__icon fa fa-check"></i><span class="app-menu__label">Responded Request</span></a></li>
    <li><a class="app-menu__item {{ Request::is('team*')?'active':'' }}" href="{{ route('team.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Team</span></a></li>
    <li><a class="app-menu__item {{ Request::is('customers')?'active':''  }}" href="{{ route('customer') }}"><i class="app-menu__icon fa fa-user-o"></i><span class="app-menu__label">Customers</span></a></li>
    <li><a class="app-menu__item {{ Request::is('user*')?'active':''  }}" href="{{ route('user.index') }}"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Admins</span></a></li>


    <li class="treeview "><a class="app-menu__item {{ Request::is('setting*')?'active':'' }}" href=" " data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item {{ Request::is('setting/contact')?'active':'' }}" href="{{ route('user.index') }}"><i class="icon fa fa-circle-o"></i>Contact</a></li>
            <li><a class="treeview-item {{ Request::is('setting/log-links')?'active':'' }}" href="{{ route('user.index') }}"><i class="icon fa fa-circle-o"></i>Logo & Links</a></li>
            <li><a class="treeview-item {{ Request::is('setting/meta')?'active':'' }}" href="{{ route('meta.index') }}"><i class="icon fa fa-circle-o"></i>Site Title & Meta tags</a></li>
            <li><a class="treeview-item {{ Request::is('setting/privacy')?'active':'' }}" href="{{ route('privacy.index') }}"><i class="icon fa fa-circle-o"></i>Privacy & Policy</a></li>
        </ul>
    </li>
</ul>
