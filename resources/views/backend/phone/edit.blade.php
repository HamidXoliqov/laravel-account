@extends('layouts.backend')
@section('title')
    {{'Edite '.$phone->number}}
@stop
@section('content')

    <!-- page content -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edite {{$phone->number}}</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{url('phone')}}">Phones</a> 
                    </li>                     
                    <li class="breadcrumb-item ">
                        <a href="{{route('phone.create')}}">Add</a>
                    </li>                    
                    <li class="breadcrumb-item active">
                        Edit
                    </li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit"></i>
                            Edit {{$phone->number}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! Form::open(['route' => ['phone.update',$phone->id],'method'=>'put']) !!}
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group row">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Number
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::text('number',$phone->number,['class'=>'form-control','placeholder' => 'Name'])}}
                                        </div>
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <p class="erros-text">{{ $message }}</p>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Account
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::select('account_id',$accounts,$phone->account_id,['class'=>'form-control','placeholder' => $phone->getAccount()])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-create">
                                        Save
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2019</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- /page content -->

@endsection
