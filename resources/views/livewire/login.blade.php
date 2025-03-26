<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form>
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                    value="{{ old('email') }}" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    wire:model="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
            <div class="row">
                <div class="col-4">
                    <button type="button" class="btn btn-primary btn-block" wire:click="loginForm">Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('script')
    <script>
        Livewire.on('checkPassword', function(data) {
            toastr.error(data.message);
        });
    </script>
@endpush
