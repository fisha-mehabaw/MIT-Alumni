<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <li class="active">
        <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{!! route('roles.index') !!}"><i class="fa fa-object-group"></i> <span>Roles</span></a>
    </li>

    <li>
        <a href="{!! route('departments.index') !!}"><i class="fa fa-institution"></i> <span>Departments</span></a>
    </li>

    <li>
        <a href="{!! route('users.index') !!}"><i class="fa fa-list"></i> <span>Users Account</span></a>
    </li>

</ul>