<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-sm-6 col-xs-6">
            <div class="form_box">
                <label for="name" class="form-label mb-2 font-18 font-heading fw-600">{{ __('Name') }}</label>
                <input type="text" class="common-input border" id="name" value="{{ $user->name }}"
                    name="name" placeholder="Name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="form_box">
                <label for="avatar" class="form-label mb-2 font-18 font-heading fw-600">{{ __('Avatar') }}</label>
                <input type="file" class="common-input border" id="avatar" name="avatar">
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="form_box">
                <label for="email" class="form-label mb-2 font-18 font-heading fw-600">{{ __('Email') }}</label>
                <input type="email" class="common-input border" id="email" name="email"
                    value="{{ $user->email }}" placeholder="Email Address">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="form_box"> <label for="country"
                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Country') }}</label>
                <div class="">
                    <select class="common-input border select_2" id="country" name="country">
                        <option value="">Select</option>
                        @foreach (config('options.countries') as $key => $value)
                            <option @selected($user->country == $value) value="{{ $value }}">{{ $value }}
                            </option>
                        @endforeach

                    </select>
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="form_box">
                <label for="city" class="form-label mb-2 font-18 font-heading fw-600">{{ __('City') }}</label>
                <input type="text" name="city" id="city" class="common-input border"
                    value="{{ $user->city }}" placeholder="City">
                <x-input-error :messages="$errors->get('city')" class="mt-2" />

            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="form_box">
                <label for="address" class="form-label mb-2 font-18 font-heading fw-600">{{ __('Address') }}</label>
                <input type="text" class="common-input border" id="address" value="{{ $user->address }}"
                    name="address" placeholder="Address">
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
        </div>
        {{-- <div class="col-sm-6 col-xs-6">
            <div class="form_box"> <label for="shipping address"
                    class="form-label mb-2 font-18 font-heading fw-600">{{ __('Shipping Address') }}</label>
                <div class="">
                    <select class="common-input border select_2" id="shipping_address" name="shipping_address">
                        <option value="">Select</option>
                        @foreach (config('options.shipping_address') as $key => $value)
                            <option @selected($user->shipping_address == $value) value="{{ $value }}">{{ $value }}
                            </option>
                        @endforeach

                    </select>
                    <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                </div>
            </div>
        </div> --}}

        <div class="col-sm-12">
            <button type="submit" class="btn btn-main btn-lg">{{ __('Update Profile') }}</button>
        </div>
    </div>
</form>
