    <form action="{{ route('password.update') }}" autocomplete="off" method="POST">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-12">
                <div class="form_box">
                    <label for="current-password" class="form-label mb-2 font-18 font-heading fw-600">Current
                        Password</label>
                    <div class="position-relative">
                        <input type="password" name="current_password" class="common-input common-input--withIcon common-input--withLeftIcon "
                            id="current-password" placeholder="************">
                        <span class="input-icon input-icon--left"><img src="{{ asset('assets/frontend/images/icons/key-icon.svg') }}"
                                alt=""></span>
                    </div>
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>
            </div>

            <div class="col-sm-6 col-xs-6">
                <div class="form_box">
                    <label for="new-password" class="form-label mb-2 font-18 font-heading fw-600">New
                        Password</label>
                    <div class="position-relative">
                        <input type="password" name="new_password" class="common-input common-input--withIcon common-input--withLeftIcon "
                            id="new_password" placeholder="************">
                        <span class="input-icon input-icon--left"><img src="{{ asset('assets/frontend/images/icons/lock-two.svg') }}"
                                alt=""></span>

                    </div>
                    <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                </div>
            </div>

            <div class="col-sm-6 col-xs-6">
                <div class="form_box">
                    <label for="confirm-password" class="form-label mb-2 font-18 font-heading fw-600">Confirm
                        Password</label>
                    <div class="position-relative">
                        <input type="password" name="new_password_confirmation" class="common-input common-input--withIcon common-input--withLeftIcon "
                            id="new_password_confirmation" placeholder="************">
                        <span class="input-icon input-icon--left"><img src="{{ asset('assets/frontend/images/icons/lock-two.svg') }}"
                                alt=""></span>

                    </div>
                    <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="col-sm-12">
                <button class="btn btn-main btn-lg"> Update
                    Password</button>
            </div>
        </div>
    </form>

