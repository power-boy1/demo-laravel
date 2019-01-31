@extends('layouts.admin')
@section('title', 'Manage user')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Users list
            </h1>
            <div class="management-controls">
                <a class="el-button el-button--primary" href="{{ route('get.manage.user.create') }}">Create</a>
            </div>
        </div>
        <div class="grid-content bg-purple-dark">
            <user-list
                    route="{{ route('get.manage.user.list') }}">
            </user-list>
        </div>
    </el-main>
@endsection