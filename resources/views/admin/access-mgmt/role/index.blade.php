@extends('admin.layouts.master')
@section('content')
    <div class="p-2">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('All Roles') }}</h3>
                                <div class="card-actions">
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary flex gap-2">
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
                                                    <td @if ($role->name != 'super admin') class="d-flex fs-2 gap-2" @endif>
                                                        @if ($role->name != 'super admin')
                                                            <a class="text-decoration-none"
                                                                href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                                    class="bi bi-pencil-square"></i></i></a>

                                                            <form action="{{ route('admin.roles.destroy', $role->id) }}"
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
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
@endsection
