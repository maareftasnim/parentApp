<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>

                    </ul>
                </li>

                <?php
                $parents =\Illuminate\Support\Facades\Auth::guard('parents')->user()->id;
                ?>
                <li class="nav-item">
                    <a href="{{route('parents.show',$parents)}}" class="nav-link ">
                        <i class="fa-fw fas fa-list nav-icon">

                        </i>
                        {{ trans('cruds.parent.title') }}
                    </a>
                </li>


                <li class="nav-item">
                    <a href="" class="nav-link ">
                        <i class="fa-fw fas fa-question nav-icon">

                        </i>
                        {{ trans('cruds.question.title') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link ">
                        <i class="fa-fw fas fa-check nav-icon">

                        </i>
                        {{ trans('cruds.option.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link ">
                        <i class="fa-fw fas fa-trophy nav-icon">

                        </i>
                       noooo
                    </a>
                </li>
            <li class="nav-item">
                <a href="{{route('parents.parents.logout')}}" class="nav-link" >
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
