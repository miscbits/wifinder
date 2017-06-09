<ul class="nav nav-sidebar">
    <li @if(Request::is('/')) class="active" @endif>
        <a href="{!! url('/') !!}"><span class="fa fa-user"></span> Home</a>
    </li>
    @if(! Auth::guest())
        <li @if(Request::is('user/settings', 'user/password')) class="active" @endif>
            <a href="{!! url('user/settings') !!}"><span class="fa fa-user"></span> Settings</a>
        </li>
    @endif
    @if (Gate::allows('admin'))
        <li class="sidebar-header"><span>Admin</span></li>
        <li @if(Request::is('admin/dashboard', 'admin/dashboard/*')) class="active" @endif>
            <a href="{!! url('admin/dashboard') !!}"><span class="fa fa-dashboard"></span> Dashboard</a>
        </li>
        <li @if(Request::is('admin/users', 'admin/users/*')) class="active" @endif>
            <a href="{!! url('admin/users') !!}"><span class="fa fa-users"></span> Users</a>
        </li>
        <li @if(Request::is('admin/roles', 'admin/roles/*')) class="active" @endif>
            <a href="{!! url('admin/roles') !!}"><span class="fa fa-lock"></span> Roles</a>
        </li>
    @endif
</ul>