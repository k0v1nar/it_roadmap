<?php

?>
<nav class="main-header navbar navbar-expand navbar-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar-full" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a href="/admin/" class="nav-link">Админка</a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a href="/" class="nav-link">На сайт</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <span class="d-none d-md-inline">{{ Auth::user()->nickname }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <li class="user-header bg-primary">
                            <p>
                                {{ Auth::user()->nickname }}
                            </p>
                            <p>
                                {{ Auth::user()->role->name }}
                            </p>
                            <img src="{{ isset(Auth::user()->path_icon) ? asset('storage/' . Auth::user()->path_icon) : asset('images/default-avatar.png') }}" 
                                     alt="Аватар сотрудника" 
                                     class="rounded-circle me-2" 
                                     width="50" 
                                     height="50">
                        </li>
                        <li class="user-footer">
                            <a class="btn btn-default btn-flat float-end" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Выход') }}
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>