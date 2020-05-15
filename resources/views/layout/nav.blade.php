<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/home')}}">Laravel Practice</a>
    <span class="text-info d-none d-lg-block">Hi,{{ Session::get('username')}}</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <ul class="navbar-nav ml-auto mr-4">
            <li class="nav-item {{ $nowwhere=="menu" ? "active" : '' }}">
                <a class="nav-link" href="{{ url('/home')}}">Home </a>
            </li>
            <li class="nav-item {{ $nowwhere=="list" ? "active" : '' }}">
                <a class="nav-link" href="{{ url('/list')}}">List</a>
            </li>
            <li class="nav-item {{ $nowwhere=="create" ? "active" : '' }}">
                <a class="nav-link" href="{{ url('/create')}}">Create</a>
            </li>
            <li class="nav-item {{ $nowwhere=="charts" ? "active" : '' }}">
                <a class="nav-link" href="{{ url('/charts')}}">Charts</a>
            </li>
        </ul>

        

        <a class="btn btn-outline-info my-2 my-sm-0 mr-2" href="{{ url('/signout')}}">Log Out</a>

    </div>

</nav>