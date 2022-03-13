<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transactions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Transactions</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Transactions | BALANCE: #{{$wallet->balance + $wallet->bonus}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Transaction type</th>
                                    <th>Reference No</th>
                                    <th>Amount<sup>(Naira)</sup></th>
                                    <th>Status</th>
                                    <th>Initiated</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($transactions)
                                    @foreach($transactions as $trans)
                                        <tr>
                                            <td>{{$trans->payment_type}}</td>
                                            <td>{{$trans->reference_no}}</td>
                                            <td>{{$trans->amount}}</td>
                                            <td>{{$trans->status}}</td>
                                            <td>{{$trans->created_at->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>No transactions</p>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Transaction type</th>
                                    <th>Reference No</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Initiated</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $transactions->links('components.pagination-links') /* For pagination links */}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
