@extends('admin.layouts.master')
@section('content')
    <div class="p-2">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('All Users') }}</h3>
                                <div class="card-actions">
                                    <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary flex gap-2">
                                        <i class="bi bi-plus"></i>
                                        {{ __('Add new') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('Roles') }}</th>
                                                <th class="w-1">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>{{ $admin->name }}</td>
                                                    <td class="text-secondary">
                                                        {{ $admin->email }}
                                                    </td>
                                                    <td>
                                                        @foreach ($admin->getRoleNames() as $role)
                                                            <span class="badge bg-blue-lt">{{ $role }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td @if ($admin->roles->first()?->name != 'super admin') class="d-flex fs-2 gap-2" @endif>
                                                        @if ($admin->roles->first()?->name != 'super admin')
                                                            <a class="text-decoration-none"
                                                                href="{{ route('admin.role-users.edit', $admin->id) }}"><i
                                                                    class="bi bi-pencil-square"></i></i></a>

                                                            <form
                                                                action="{{ route('admin.role-users.destroy', $admin->id) }}"
                                                                method="POST" class="delete-role-form">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button class="btn-link text-decoration-none"
                                                                    type="submit"><i
                                                                        class="bi bi-trash3 text-danger"></i></i></button>

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
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
@endsection
