@extends('admin.layouts.master')
@section('content')
    <div class="p-2">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Create Roles') }}</h3>
                                <div class="card-actions">
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-primary flex gap-2">
                                        <i class="bi bi-arrow-left"></i>
                                        {{ __(' Back to All Roles') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="roleForm" action="{{ route('admin.roles.store') }}" method="POST">
                                    @csrf

                                    {{-- role field --}}
                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">{{ __('Role') }}</label>
                                        <input id="name" name="name" type="text" class="form-control"
                                            placeholder="Role">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                    </div>
                                    <hr>
                                    <div class="row">
                                        @foreach ($permissions as $groupName => $permissionItems)
                                            <div class="col-md-4">
                                                <h3>{{ $groupName }}</h3>
                                                @foreach ($permissionItems as $permission)
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox"
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
                                    <button class="btn btn-primary" onclick="$('#roleForm').submit()" type="submit">{{ __('Create') }}</button>
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
