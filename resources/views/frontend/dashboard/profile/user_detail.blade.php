<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column align-items-center text-center">
            <img src="{{ asset($user->avatar) }}" alt="User" class="rounded-circle p-1" style="background-color: #244960;" width="110">
            <div class="mt-3">
                <h4>{{ $user->name }}</h4>
                <p class="text-secondary mb-1">{{ $user->user->user_type }}</p>

            </div>
        </div>
        <hr class="my-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><i class="fadeIn animated bx bx-book-open"></i> Grade</h6>
                @if ($user->user_type == 'student')
                <span class="text-secondary">{{ $user->grade->name }}</span>

                @else
                hello
                @endif
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><i class="fadeIn animated bx bx-calendar-star"></i> DOB (AD)</h6>
                <span class="text-secondary">{{ $user->date_of_birth }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><i class="fadeIn animated bx bx-book-open"></i> Country</h6>
                <span class="text-secondary">{{ $user->country }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><i class="fadeIn animated bx bx-book-open"></i> City</h6>
                <span class="text-secondary">{{ $user->city }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><i class="fadeIn animated bx bx-book-open"></i> Address</h6>
                <span class="text-secondary">{{ $user->address }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><i class="fadeIn animated bx bx-book-open"></i> Postal Code</h6>
                <span class="text-secondary">{{ $user->postal_code }}</span>
            </li>

        </ul>
    </div>
</div>
