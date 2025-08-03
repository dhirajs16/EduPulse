@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('Roles') }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Roles List') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary radius-30"
                    style="background-color: #244960;"><i class="bx bxs-plus-square"></i>Add New Role</a>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card p-4">
            <div class="card-body">
                <h4 class="card-title">{{ __('All Roles') }}</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>{{ __('Role Name') }}</th>
                                <th>{{ __('Permissions') }}</th>
                                <th class="w-1">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-secondary">
                                        @if ($role->name === 'super admin')
                                            <span>All Permissions</span>
                                        @else
                                            {{ $role->permissions_count }}
                                        @endif
                                    </td>

                                    {{--  --}}
                                    <td @if ($role->name != 'super admin') class="d-flex fs-4 gap-2" @endif>
                                        @if ($role->name != 'super admin')
                                            <a class="text-decoration-none"
                                                href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                    class="bx bxs-edit text-black"></i></a>

                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                                class="delete-role-form">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn-link text-decoration-none border-0 bg-white"
                                                    type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this role?');">
                                                    <i class="bx bxs-trash text-black"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">{{ __('No Any Roles.') }}</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

                <div class="card-actions">
                    <a href="#" class="">

                    </a>
                </div>
            </div>
        </div>

        @include('admin.layouts.footer')
    </div>
@endsection
