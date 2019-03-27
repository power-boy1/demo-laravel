@extends('layouts.admin')
@section('title', 'Manage roles')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Roles list
            </h1>
            <div class="management-controls">
                <a class="el-button el-button--primary" href="{{ route('get.manage.role.create') }}">Create</a>
            </div>
        </div>
        <div class="grid-content bg-purple-dark">
            <role-list
                    route="{{ route('get.manage.role.list') }}">
            </role-list>
        </div>
    </el-main>
@endsection