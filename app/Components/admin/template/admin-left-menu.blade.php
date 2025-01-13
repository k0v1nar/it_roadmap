<?php 
    use App\Components\admin\Auth;
?>

<aside class="main-sidebar sidebar-bg-dark sidebar-color-primary shadow">
    <div class="brand-container">
        <a href="javascript:;" class="brand-link">
            <span class="brand-text fw-light">IT-roadmap</span>
        </a>
        <a class="pushmenu mx-1" data-lte-toggle="sidebar-mini" href="javascript:;" role="button"><i class="fas fa-angle-double-left"></i></a>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <!-- Sidebar Menu -->
            <ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item <?=($page_name == 'index' ? 'menu-open' : '')?>">
                    <a href="<?=route('admin.index')?>" class="nav-link <?=($page_name == 'index' ? 'active' : '')?>">
                        <i class="nav-icon fa fa-book fa-fw"></i>
                        <p>Главная</p>
                    </a>
                </li>

                <li class="nav-header">Курсы</li>

                <li class="nav-item <?=($page_name == 'curs' ? 'menu-open' : '')?>">
                    <a href="<?=route('admin.curs.index')?>" class="nav-link <?=($page_name == 'curs' ? 'active' : '')?>">
                        <i class="nav-icon fas fa-bezier-curve fa-fw"></i>
                        <p>Курсы</p>
                    </a>
                </li>
                <li class="nav-item <?=($page_name == 'steps' ? 'menu-open' : '')?>">
                    <a href="<?=route('admin.steps.index')?>" class="nav-link <?=($page_name == 'steps' ? 'active' : '')?>">
                        <i class="nav-icon fas fa-tasks fa-fw"></i>
                        <p>Этапы</p>
                    </a>
                </li>
                <li class="nav-item <?=($page_name == 'urls' ? 'menu-open' : '')?>">
                    <a href="<?=route('admin.steps.urls.index')?>" class="nav-link <?=($page_name == 'urls' ? 'active' : '')?>">
                        <i class="nav-icon fas fa-link fa-fw"></i>
                        <p>Ссылки</p>
                    </a>
                </li>
                <li class="nav-item <?=($page_name == 'achievments' ? 'menu-open' : '')?>">
                    <a href="<?=route('admin.achievement.index')?>" class="nav-link <?=($page_name == 'achievments' ? 'active' : '')?>">
                        <i class="nav-icon fas fa-trophy fa-fw"></i>
                        <p>Достижения</p>
                    </a>
                </li>

                @if (Auth::isAdmin())
                    <li class="nav-header">Пользователи</li>

                    <li class="nav-item <?=($page_name == 'users' ? 'menu-open' : '')?>">
                        <a href="<?=route('admin.user.index')?>" class="nav-link <?=($page_name == 'users' ? 'active' : '')?>">
                            <i class="nav-icon fas fa-users fa-fw"></i>
                            <p>Клиенты</p>
                        </a>
                    </li>
                    <li class="nav-item <?=($page_name == 'selected_curs' ? 'menu-open' : '')?>">
                        <a href="<?=route('admin.index')?>" class="nav-link <?=($page_name == 'selected_curs' ? 'active' : '')?>">
                            <i class="nav-icon fas fa-poll fa-fw"></i>
                            <p>Прогресс курсов</p>
                        </a>
                    </li>
                    <li class="nav-item <?=($page_name == 'achievments_get' ? 'menu-open' : '')?>">
                        <a href="<?=route('admin.user.achievement.index')?>" class="nav-link <?=($page_name == 'achievments_get' ? 'active' : '')?>">
                            <i class="nav-icon fas fa-award fa-fw"></i>
                            <p>Полученные достижения</p>
                        </a>
                    </li>
                @endif

                @if (Auth::isSuperAdmin())
                    <li class="nav-header">Настройки</li>

                    <li class="nav-item <?=($page_name == 'admins' ? 'menu-open' : '')?>">
                        <a href="<?=route('admin.admin.index')?>" class="nav-link <?=($page_name == 'admins' ? 'active' : '')?>">
                            <i class="nav-icon fas fa-users fa-fw"></i>
                            <p>Сотрудники</p>
                        </a>
                    </li>
                    <li class="nav-item <?=($page_name == 'roles' ? 'menu-open' : '')?>">
                        <a href="<?=route('admin.role.index')?>" class="nav-link <?=($page_name == 'roles' ? 'active' : '')?>">
                            <i class="nav-icon fas fa-user-tag fa-fw"></i>
                            <p>Роли сотрудников</p>
                        </a>
                    </li>
                    <li class="nav-item <?=($page_name == 'settings' ? 'menu-open' : '')?>">
                        <a href="<?=route('admin.index')?>" class="nav-link <?=($page_name == 'settings' ? 'active' : '')?>">
                            <i class="nav-icon fa fa-wrench fa-fw"></i>
                            <p>Настройки</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
