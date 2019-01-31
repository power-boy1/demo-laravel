@extends('layouts.admin')
@section('title', 'Manage user')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Create user
            </h1>
        </div>
        <user-create
                route-back="{{ route('get.manage.user.show') }}"
                csrf_token="{{ csrf_token() }}"
                action="{{ route('post.manage.user.create')}}"
                method="post"
                old-data="{{ json_encode(old()) }}"
                array-error-message="{{ $errors }}"
        >
        </user-create>
    </el-main>
@endsection