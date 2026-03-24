<section>
    <header class="mb-4">
        <h2 class="h5 fw-bold text-dark mb-1">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted small mb-0">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="d-none">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-medium text-secondary small mb-1">
                {{ __('Name') }}
            </label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-control py-2 @error('name') is-invalid @enderror" 
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name" 
            />
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-medium text-secondary small mb-1">
                {{ __('Email') }}
            </label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-control py-2 @error('email') is-invalid @enderror" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username" 
            />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-3">
                    <p class="text-dark small mb-0 d-flex align-items-center flex-wrap gap-1">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                        {{ __('Your email address is unverified.') }}
                        
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none fw-medium small ms-1">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 mb-0 fw-medium text-success small">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-dark px-4 rounded-3 shadow-sm">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success small fw-medium mb-0 ms-3"
                >
                    <i class="bi bi-check-circle me-1"></i> {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>