@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ __('Role Users') }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Role Users List') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary radius-30"
                    style="background-color: #244960;"><i class="bx bxs-plus-square"></i>{{ __('Add New Role User') }}</a>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h4 class="card-title">{{ __('All Users') }}</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>{{ __('Avatar') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Roles') }}</th>
                                <th class="w-1">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins->sortBy('id') as $admin)
                                <tr>
                                    <td>
                                        <img src="{{ asset($admin->avatar) }}" alt="avatar" width="40" height="40"
                                            class="rounded-circle">

                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td class="text-secondary">
                                        {{ $admin->email }}
                                    </td>
                                    <td>
                                        @foreach ($admin->getRoleNames() as $role)
                                            <span
                                                class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i
                                                    class="bx bxs-circle me-1"></i>{{ $role }}</span>
                                        @endforeach
                                    </td>
                                    <td @if ($admin->roles->first()?->name != 'super admin') class="d-flex fs-4 gap-2" @endif>
                                        @if ($admin->roles->first()?->name != 'super admin')
                                            <a class="text-decoration-none"
                                                href="{{ route('admin.role-users.edit', $admin->id) }}"><i
                                                    class="bx bxs-edit text-black"></i></a>

                                            <form action="{{ route('admin.role-users.destroy', $admin->id) }}"
                                                method="POST" class="delete-role-form">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn-link text-decoration-none border-0 bg-white"
                                                    type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="bx bxs-trash text-black"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>

        @include('admin.layouts.footer')
    </div>
@endsection
