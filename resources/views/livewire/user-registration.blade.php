
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1">S-Bo<b>x</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Create a savings account</p>
            <x-alert />
            <form wire:submit.prevent="register">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" required wire:model.lazy="name" class="form-control {{$errors->has('name')? 'is-invalid' : '' }}" placeholder="Full name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="input-group mb-3">
                    <input type="email" required wire:model.lazy="email" class="form-control {{$errors->has('email')? 'is-invalid' : '' }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror


                <div class="input-group mb-3">
                    <input required type="password" wire:model.lazy="password" class="form-control {{$errors->has('password')? 'is-invalid' : '' }}" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="input-group mb-3">
                    <input required type="password" wire:model.lazy="password_confirmation" class="form-control {{$errors->has('password_confirmation')? 'is-invalid' : '' }}" placeholder="Confirm password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password_confirmation') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <small>Checkout date</small>
                <div class="input-group mb-3">
                    <input type="date" required wire:model.lazy="checkout_date" class="form-control {{$errors->has('checkout_date')? 'is-invalid' : '' }}" placeholder="Checkout date">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('checkout_date') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button wire:loading.remove wire:target="register" type="submit" class="btn btn-primary btn-block"> Create account</button>
                        <button disabled wire:loading wire:target="register" type="submit" class="btn btn-primary btn-block">  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="{{route('login')}}" style="margin-right: 35%;"><li  class="fa fa-user"></li> Already have an account?</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
