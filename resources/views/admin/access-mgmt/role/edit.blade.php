@extends('admin.layouts.master')
@section('content')
    <div class="p-2">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Edit Role') }}</h3>
                                <div class="card-actions">
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg> --}}
                                        {{ __('Go Back to All Roles') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="roleForm" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    {{-- role field --}}
                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">{{ __('Role') }}</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            placeholder="Role" value="{{ $role->name }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    </div>
                                    <hr>
                                    <div class="row">
                                        @foreach ($permissions as $groupName => $permissionItems)
                                            <div class="col-md-4">
                                                <h3>{{ $groupName }}</h3>
                                                @foreach ($permissionItems as $permission)
                                                    <label class="form-check">
                                                        <input @checked($role->hasPermissionTo($permission->name)) class="form-check-input" type="checkbox"
                                                            value="{{ $permission->name }}" name="permissions[]">
                                                        <span class="form-check-label">{{ $permission->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endforeach

                                    </div>
                                </form>
                            </div>


                            <div class="card-footer">
                                <div class="card-actions text-end">
                                    {{-- submit button --}}
                                    <button class="btn btn-primary" onclick="$('#roleForm').submit()" type="submit">{{ __('Edit') }}</button>
                                </div>
                            </div>
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
