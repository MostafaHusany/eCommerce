<!-- Start Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{url('/')}}">AdminPage</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li @if(Request::is('admin/dashboard')) class="active" @endif><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li @if(Request::is('admin/users')) class="active" @endif><a href="{{route('admin.users')}}">  Users</a></li>
        <li @if(Request::is('admin/categories')) class="active" @endif><a href="{{route('admin.categories')}}"> Categories</a></li>
        <li @if(Request::is('admin/products')) class="active" @endif><a href="{{route('admin.products')}}">  Products</a></li>
        <li @if(Request::is('admin/orders')) class="active" @endif><a href="{{route('admin.orders')}}">  Orders</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="!active"><a href="#">Welcome, {{isset(auth::user()->name) ? auth::user()->name : 'guest'}} </a></li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<!-- End Navbar -->

<!-- Start Header -->
<header id="header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <small>Manage Your App</small></h1>
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </div><!-- contact -->
</header>
<!-- End Header -->
