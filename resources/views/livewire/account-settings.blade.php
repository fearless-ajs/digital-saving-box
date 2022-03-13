
<div class="login-box" style="margin: auto; margin-top: 200px;">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-body">
            <p class="login-box-msg">Update your account details</p>
            <x-alert />
            <form wire:submit.prevent="updateAccount">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" required wire:model.lazy="name" class="form-control {{$errors->has('name')? 'is-invalid' : '' }}" placeholder="Account name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="input-group mb-3">
                    <input type="number" required wire:model.lazy="number" class="form-control {{$errors->has('number')? 'is-invalid' : '' }}" placeholder="Account number">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('number') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror


                <div class="input-group mb-3">
                    <select wire:model.lazy="type"  class="form-control {{$errors->has('type')? 'is-invalid' : '' }}">
                        <option value="">Select account type</option>
                        <option value="Current">Current</option>
                        <option value="Savings">Savings</option>
                    </select>
                </div>
                @error('type') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="input-group mb-3">
                      <select wire:model.lazy="bank" class="form-control {{$errors->has('bank')? 'is-invalid' : '' }}" >
                        <option value="">Choose Bank</option>
                        <option value="044">Access Bank</option>
                        <option value="023">  Citibank</option>
                        <option value="050">Ecobank</option>
                        <option value="214">First City Monument Bank (FCMB)</option>
                        <option value="070">Fidelity Bank</option>
                        <option value="011">First Bank</option>

                        <option value="058">Guaranty Trust Bank (GTB)</option>
                        <option value="030">Heritage Bank</option>
                        <option value="301">Jaiz Bank</option>
                        <option value="082">Keystone Bank</option>
                        <option value="526">Parallex Bank</option>
                        <option value="101">Providus Bank</option>
                        <option value="221">Stanbic IBTC Bank</option>
                        <option value="076">Skye Bank</option>
                        <option value="068">Standard Chartered Bank</option>
                        <option value="232">Sterling Bank</option>
                        <option value="100">Suntrust Bank</option>
                        <option value="102"> Titan Trust Bank</option>
                        <option value="032">Union Bank</option>
                        <option value="033">United Bank for Africa (UBA)</option>
                        <option value="215">Unity Bank</option>
                        <option value="035">Wema Bank</option>
                        <option value="052">Zenith Bank</option>
                    </select>
                </div>
                @error('bank') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror

                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button wire:loading.remove wire:target="updateAccount" type="submit" class="btn btn-primary btn-block"> Update account</button>
                        <button disabled wire:loading wire:target="updateAccount" type="submit" class="btn btn-primary btn-block">  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
