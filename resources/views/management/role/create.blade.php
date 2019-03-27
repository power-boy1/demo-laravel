@extends('layouts.admin')
@section('title', 'Manage role')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Create role
            </h1>
        </div>
        <role-create
                route-back="{{ route('get.manage.role.show') }}"
                csrf_token="{{ csrf_token() }}"
                action="{{ route('post.manage.role.create')}}"
                old-data="{{ json_encode(old()) }}"
                array-error-message="{{ $errors }}"
        >
        </role-create>
    </el-main>
@endsection