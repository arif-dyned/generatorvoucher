<div class="leftside-navigation">
    <ul class="sidebar-menu" id="nav-accordion">
        <li>
            <a class="active" href="{{url('/')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li><a href="{{ url('organizations') }}"><i class="fa fa-users"></i> Organizations</a></li>

        <li class="sub-menu">
            <a href="javascript:;">
                <i class="fa fa-laptop"></i>
                <span>Settings</span>
            </a>
            <ul class="sub">
                <li><a href="{{ url('user-manager') }}">Users</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>