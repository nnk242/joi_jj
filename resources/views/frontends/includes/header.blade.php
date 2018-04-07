<!-- Header -->
<header class="header-down">
    <div class="border-bottom border-info">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-top border-light m-opacity-9">
            <a href="{{asset('/')}}" class="navbar-brand">
                <img src="{{asset('logo.png')}}" height="35px" alt="" class="d-inline-block align-top">
            </a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                    class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto"></ul>
                <div class="form-inline my-2 my-lg-0">
                    <form class="form-inline" method="GET" action="{{url('/')}}">
                        <select class="form-control mr-sm-2" id="select-repo" name="tim-kiem" placeholder="Tìm kiếm..."></select>
                        <button type="submit" class="btn btn-outline-light my-2 my-sm-0 text-info"><i
                                    class="fa fa-search"></i> Tìm kiếm
                        </button>
                    </form>

                </div>
            </div>
        </nav>
    </div>
</header>
<!--end header-->