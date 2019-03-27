<?php
    switch (Route::getCurrentRoute()->getPrefix()) {
        case 'management/users':
            $tabIndex = 1;
            break;
        case 'management/roles':
            $tabIndex = 2;
            break;
        default:
            $tabIndex = 1;
            break;
    }
?>
<el-aside class="sidebar" width="250px">
    <el-menu
            default-active="{{ $tabIndex }}"
            class="menu">
        <el-menu-item index="1" class="menu-item">
            <a class="menu-link" href="{{ route('get.manage.user.show') }}">
                <i class="el-icon-menu"></i>
                <span>Users</span>
            </a>
        </el-menu-item>
        <el-menu-item index="2" class="menu-item">
            <a class="menu-link" href="{{ route('get.manage.role.show') }}">
                <i class="el-icon-menu"></i>
                <span>Roles</span>
            </a>
        </el-menu-item>
    </el-menu>
    <a class="menu-link menu-back" href="{{ route('get.home') }}">
        <i class="el-icon-arrow-left menu-back-icon"></i>
        <span>Main page</span>
    </a>
</el-aside>