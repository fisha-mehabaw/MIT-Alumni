
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>

    <li class="active">
        <a href="{{ route('alumnies.home') }}">
            <i class="fa fa-home"></i> <span>Home</span>
        </a>
    </li>

    <li>
        <a href="{!! route('alumniesProfile.index') !!}"><i class="fa fa-user-secret"></i> <span> Profile</span></a>
    </li>

    <li>
        <a href="{!! route('documentRequest.index') !!}"><i class="fa fa-book"></i> <span>Document Request</span></a>
    </li>

    <li>
        <a href="{!! route('alumnies.list') !!}"><i class="fa fa-search"></i> <span>Search Alumnies</span></a>
    </li>

    <li>
        <a href="{!! route('posts.index') !!}"><i class="fa fa-forumbee"></i> <span>Forum</span></a>
    </li>

</ul>
