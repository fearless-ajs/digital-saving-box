@if(session()->has('status'))
    <br>
    <div class="alert alert-success alert-dismissible fade show" style="text-align: center;" role="alert">
        <strong>{{session()->get('status')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('error'))
    <br>
    <div class="alert alert-danger alert-dismissible fade show" style="text-align: center;" role="alert">
        <strong> {{session()->get('error')}} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


