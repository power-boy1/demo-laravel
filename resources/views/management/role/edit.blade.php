@extends('layouts.admin')
@section('title', 'Manage role')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Edit role
            </h1>
        </div>
        <role-edit
                route-back="{{ route('get.manage.role.show') }}"
                csrf_token="{{ csrf_token() }}"
                action="{{ route('post.manage.role.update')}}"
                item-data="{{ $role }}"
                old-data="{{ json_encode(old()) }}"
                array-error-message="{{ $errors }}"
        >
        </role-edit>
    </el-main>
@endsection