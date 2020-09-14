@extends('layouts.admin')

@section('content')

  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">System statistics</h3>
    </div><!-- /.panel-heading -->
    <div class="panel-body">
      <div class="row">
        <div class="col-md-4">
          <div class="well text-center">
            <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$usersCount}}</h2>
            <h4>Users</h4>
          </div>
        </div><!-- col-4 -->
        <div class="col-md-4">
          <div class="well text-center text-primary">
            <h2 class=""><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{$productsCount}}</h2>
            <h4>Products</h4>
          </div>
        </div><!-- col-4 -->
        <div class="col-md-4">
          <div class="well text-center">
            <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> {{'0'}}</h2>
            <h4>Orders</h4>
          </div>
        </div><!-- col-4 -->
      </div><!-- /.row -->
    </div><!-- /.panel-body -->
  </div><!-- /.panel -->

  <div class="row">
    <div class="col-md-6">
      <!-- latest User -->
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">latest reserved orders for "{{Date('Y-m-d')}}"</h3></div>
        <div class="panel-body panal-body-container">
          <table class="table table-striped">
            <tr>
              <th>call time</th>
              <th>reserved by</th>
              <th class="text-center">controle</th>
            </tr>

          </table>
        </div><!-- /.panel-body -->
      </div><!-- /.panel -->
    </div><!-- /.col-md-6 -->

    <dov class="col-md-6">
      <!-- latest User -->
      <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">latest joined users</h3></div>
        <div class="panel-body panal-body-container">
          <table class="table table-striped table-hover">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Joined</th>
            </tr>
            @foreach($latestUsers as $user)
            <tr>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{explode(' ', $user->created_at)[0]}}</td>
            </tr>
            @endforeach
          </table>
        </div><!-- /.panel-body -->
      </div><!-- /.panel -->
    </div><!-- /.col-md-6 -->
  </div><!-- /.row -->
@endsection
