@extends('layouts.admin')
@section('title', 'Manage user')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Edit user
            </h1>
        </div>
        <user-edit
                route-back="{{ route('get.manage.user.show') }}"
                csrf_token="{{ csrf_token() }}"
                action="{{ route('post.manage.user.update')}}"
                method="post"
                item-data="{{ $user }}"
                old-data="{{ json_encode(old()) }}"
                array-error-message="{{ $errors }}"
        >
        </user-edit>
    </el-main>
@endsection