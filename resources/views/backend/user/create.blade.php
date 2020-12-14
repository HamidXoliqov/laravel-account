@extends('layouts.backend')
@section('title')
    {{'Create User'}}
@stop
@section('content')

    <!-- page content -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Create User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{url('users')}}">Users</a> 
                    </li>                    
                    <li class="breadcrumb-item active">
                        Add
                    </li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus-square"></i>
                        Create User
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! Form::open(['route' => 'users.store','files'=>'true']) !!}
                            <div class="row">
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            User name
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::text('name',null,['class'=>'form-control','placeholder' => 'User name'])}}
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <p class="erros-text">{{ $message }}</p>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>                            
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Email
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::text('email',null,['class'=>'form-control','placeholder' => 'Email'])}}
                                         @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <p class="erros-text">{{ $errors->first('email') }}</p>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>                           
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Password
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::password('password',['class'=>'form-control','placeholder' => 'Password'])}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <p class="erros-text">{{ $errors->first('password') }}</p>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>                            
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Confirmation password
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::password('password_confirmation',['class'=>'form-control','placeholder' => 'Confirmation password'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">Image</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::file('image')}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                            Role
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            {{Form::select('role', $role, null, ['placeholder' => 'Default','class'=>'form-control'])}}
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


