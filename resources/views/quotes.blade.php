@extends('layouts.theme.template')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
                <div class="container-fluid">
                 
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Daily Quotes</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Quotes</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Quotes</h3>
                <div class="card-tools">
                    
                    <button type="button"  id="refresh-page" onClick="javascript:location.reload()" class="btn btn-sm btn-primary">Refresh</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Quotes</th>
                        <th>Autor</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->q}}</td>
                            <td>{{$item->a}}</td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection