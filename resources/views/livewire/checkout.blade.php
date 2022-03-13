
<div class="login-box" style="margin: auto; margin-top: 200px;">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">

        @if($checkoutForm)
        <div class="card-body">
            <p class="login-box-msg">Enter you wish to withdraw</p>
            <x-alert />
            <form wire:submit.prevent="withdraw">
                @csrf
                <div class="input-group mb-3">
                    <input type="number" required wire:model.lazy="amount" class="form-control {{$errors->has('amount')? 'is-invalid' : '' }}" placeholder="Amount">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-cash-register"></span>
                        </div>
                    </div>
                </div>
                @error('amount') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button wire:loading.remove wire:target="withdraw" type="submit" class="btn btn-primary btn-block"> Withdraw</button>
                        <button disabled wire:loading wire:target="withdraw" type="submit" class="btn btn-primary btn-block">  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p style="text-align: center; width: 100%">
                <small wire:click="showExtensionForm" style="color: #0c84ff; text-align: center; cursor: pointer">Extend checkout date</small>
            </p>

        </div>
        @endif

        @if($extensionForm)
        <div class="card-body">
            <p class="login-box-msg">Enter the extension date</p>
            <x-alert />
            <form wire:submit.prevent="extendCheckout">
                @csrf
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
                        <button wire:loading.remove wire:target="extendCheckout" type="submit" class="btn btn-primary btn-block"> Extend checkout</button>
                        <button disabled wire:loading wire:target="extendCheckout" type="submit" class="btn btn-primary btn-block">  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p style="text-align: center; width: 100%">
                <small wire:click="showCheckoutForm" style="color: #0c84ff; text-align: center; cursor: pointer">Checkout now</small>
            </p>
        </div>
        @endif

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
