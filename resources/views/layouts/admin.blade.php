<!DOCTYPE HTML>

<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Admin Area | Dashboard</title>
    <link rel="stylesheet" href="{{asset('css\bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css\main.css')}}">
    <!--- script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script-->
    <link rel="stylesheet" href="{{asset('font-awesome-4/css/font-awesome.min.css')}}">
    <script src="{{asset('js\jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js\bootstrap.min.js')}}"></script>

    <style>
      @media (max-width: 991px) {
        #main-controller {
          display: none;
        }
      }

      #loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #0cbaba; /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;

        position: absolute;
        top: 50%;
        right: 50%;
        z-index: 1000000;
        margin-right: -60px;
        margin-top: -60px;

        display: none;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
    </style>
  </head>

  <body>
    <div class="loader" id="loader"></div>

    @include('incs.navbar')

    @include('incs.breadcrumb')

    <!-- Start Main -->
    <section id="main">
      <div class="container">
        <div class="row">

          <div class="col-xs-12">
            <div class="alert alert-danger" id="general-err-msg" style="display: none">
              <b>Something went rong please refresh the page !!</b>
            </div><!-- /.alert -->
          </div><!-- /.col-xs-12 -->

          <div id="main-controller" class="col-md-3 col-sm-12">
            <div class="list-group">
              <a href="{{route('admin.dashboard')}}"  class="list-group-item @if(Request::is('admin')) main-color-bg @endif">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard <!--span class="badge" id="badge-dashboard">-</span-->
              </a>

              <a href="{{route('admin.users')}}"      class="list-group-item @if(Request::is('admin/users')) main-color-bg @endif">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <!-- span class="badge">-</span-->
              </a>

              <a href="{{route('admin.categories')}}" class="list-group-item @if(Request::is('admin/categories')) main-color-bg @endif">
                <i class="fa fa-sitemap" aria-hidden="true"></i> Categories <!-- span class="badge">-</span-->
              </a>

              <a href="{{route('admin.products')}}"   class="list-group-item @if(Request::is('admin/products')) main-color-bg @endif">
                <i class="fa fa-tags" aria-hidden="true"></i> Products <!-- span class="badge">-</span-->
              </a>

              <a href="{{route('admin.orders')}}"   class="list-group-item @if(Request::is('admin/orders')) main-color-bg @endif">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Orders <!-- span class="badge">-</span-->
              </a>
            </div><!-- /.list-group -->
          </div><!-- col-3 -->

          <!-- Start Content -->
          <div class="col-md-9 col-sm-12">
          @yield('content')
          </div><!-- col-9 -->
          <!-- Ebd Content -->
        </div><!-- /.row -->
      </div>
    </section>
    <!-- End Main -->


    <script>
    window.addEventListener('load', () => {
      // let DataController  = (function () {
      //   let postRequest = async function (url, reqData) {
      //     let response = await fetch(url, {
      //       method  : 'POST',
      //       headers : {'Content-Type' : 'application/json'},
      //       body    : JSON.stringify(reqData)
      //     });
      //     return response.json();
      //   };
      //
      //   let getRequest  = async function (url) {
      //     let response = await fetch(url);
      //
      //     return response.json();
      //   }
      //
      //   return {
      //     postRequest : postRequest,
      //     getRequest  : getRequest
      //   };
      // })();
      //
      // let UIController    = (function () {
      // });
      //
      // let MainController  = (function (DataCtr, UICtr) {
      //   DataCtr.getRequest(`?key=all`)
      //   .then(data => {
      //     console.log('test', data);
      //     $('#badge-calls').text(data);
      //   });
      //
      //   DataCtr.getRequest(`?key=calls`)
      //   .then(data => {
      //     console.log('test', data);
      //     $('#badge-dashboard').text(data);
      //   });
      //
      // })(DataController, UIController);
    });
    </script>
  </body>
</html>
