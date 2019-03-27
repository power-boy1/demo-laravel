@extends('layouts.admin')
@section('title', 'Manage role')

@section('content')
    <el-main>
        <div class="management-header">
            <h1 class="management-title">
                Role details
            </h1>
            <div class="management-controls">
                <a href="{{ route('get.manage.role.edit', ['id' => $role->id]) }}">
                    <el-button type="primary">
                        Edit
                    </el-button>
                </a>
                <modal-confirm
                        route-delete="{{ route('post.manage.role.delete') }}"
                        text="Are you sure you want to delete the role?"
                        id="{{ $role->id }}"
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
                <td class="table-col">{{ $role->name }}</td>
            </tr>
            <tr class="table-row">
                <td class="table-col">Description</td>
                <td class="table-col">{{ $role->description }}</td>
            </tr>
        </table>
    </el-main>
@endsection