@if(session('mes'))
    <div class="m-error">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successful!</strong> {{session('mes')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
@if(session('er'))
    <div class="m-error">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{session('er')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif