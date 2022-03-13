
<div class="login-box" style="margin: auto; margin-top: 200px;">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-body">
            <p class="login-box-msg">Enter you want to deposit</p>
            <x-alert />
            <form wire:submit.prevent="deposit">
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
                        <button wire:loading.remove wire:target="deposit" type="submit" class="btn btn-primary btn-block"> Deposit</button>
                        <button disabled wire:loading wire:target="deposit" type="submit" class="btn btn-primary btn-block">  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
