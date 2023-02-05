<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <li class="active">
        <a href="{{ route('registrar.home') }}">
            <i class="fa fa-home"></i> <span>Home</span>
        </a>
    </li>

    <li>
        <a href="{!! route('alumnies.index') !!}"><i class="fa fa-user-secret"></i> <span>Alumnies</span></a>
    </li>

    <li>
        <a href="{!! route('membershipRequests.index') !!}"><i class="fa fa-sign-in"></i> <span>Membership Request</span></a>
    </li>

    <li>
        <a href="{!! route('reports') !!}"><i class="fa fa-pie-chart"></i> <span>Alumni Report</span></a>
    </li>

    <li>
        <a href="{!! route('documentRequests') !!}"><i class="fa fa-book"></i> <span>Document Request</span></a>
    </li>

</ul>