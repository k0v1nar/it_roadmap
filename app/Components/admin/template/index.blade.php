<?php
use App\Components\admin\Auth;
?>

@extends('admin.template.admin-template', [
    'page_name' => "main",
])

@section('main-content')
    <div class="admin-menu-main justify-content-center">
        <a href="<?=route('admin.curs.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-bezier-curve"></i>
            </span>
            <span class="name-box">
                Курсы
            </span>
        </a>
        <a href="<?=route('admin.steps.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-tasks"></i>
            </span>
            <span class="name-box">
                Этапы
            </span>
        </a>
        
        <a href="<?=route('admin.steps.urls.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-link"></i>
            </span>
            <span class="name-box">
                Ссылки
            </span>
        </a>
        <a href="<?=route('admin.achievement.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-trophy"></i>
            </span>
            <span class="name-box">
                Достижения
            </span>
        </a>
         @if (Auth::isAdmin())
        <a href="<?=route('admin.user.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-users"></i>
            </span>
            <span class="name-box">
                Клиенты
            </span>
        </a>
        <a href="<?=route('admin.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-poll"></i>
            </span>
            <span class="name-box">
                Прогресс курсов
            </span>
        </a>
        <a href="<?=route('admin.user.achievement.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-award"></i>
            </span>
            <span class="name-box">
                Полученные достижения
            </span>
        </a>
        @endif
        @if (Auth::isSuperAdmin())
        <a href="<?=route('admin.admin.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-users"></i>
            </span>
            <span class="name-box">
                Сотрудники
            </span>
        </a>
        <a href="<?=route('admin.role.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fas fa-user-tag"></i>
            </span>
            <span class="name-box">
                Роли сотрудников
            </span>
        </a>
        <a href="<?=route('admin.index')?>" class="m-cont">
            <span class="pic-box">
                <i class="fa fa-wrench"></i>
            </span>
            <span class="name-box">
                Настройки
            </span>
        </a>
        @endif
    </div>
@endsection