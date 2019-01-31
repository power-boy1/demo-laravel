@extends('layouts.admin')
@section('title', 'Manage user')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                User details
            </h1>
            <div class="management-controls">
                <a href="{{ route('get.manage.user.edit', ['id' => $user->id]) }}">
                    <el-button type="primary">
                        Edit
                    </el-button>
                </a>
                <modal-confirm
                        route-delete="{{ route('post.manage.user.delete') }}"
                        text="Are you sure you want to delete the user?"
                        id="{{ $user->id }}"
                        csrf_token="{{ csrf_token() }}">

                </modal-confirm>
            </div>
        </div>
        <table class="table">
            <tr class="table-heading">
                <th class="table-heading-col disabled">Field</th>
                <th class="table-heading-col disabled">Value</th>
            </tr>
            <tr class="table-row">
                <td class="table-col">Name</td>
                <td class="table-col">{{ $user->name }}</td>
            </tr>
            <tr class="table-row">
                <td class="table-col">Description</td>
                <td class="table-col">{{ $user->email }}</td>
            </tr>
        </table>
    </el-main>
@endsection