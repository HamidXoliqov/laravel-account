
@extends('layouts.backend')
@section('title')
    {{'Email'}}
@stop

@section('content')

    <!-- page content -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Email</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Email
                    </li>                    
                    <li class="breadcrumb-item ">
                        <a href="{{route('email.create')}}">Add</a>
                    </li>
                    <!-- Navbar Search-->
                    <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('emailsearch') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Search for..." value="" name="q" autocomplete="off" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Navbar-->
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>DataTable Email
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10px">№</th>
                                        <th>E-mail</th>
                                        <th>Account</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                @if (count($emails)>0)
                                <tbody>
                                    @php $i=1 @endphp
                                    @foreach($emails as $value)
                                        <tr>
                                            <td>@php echo $i++ @endphp</td>
                                            <td>
                                                {{$value->email_name}}
                                            </td>
                                            <td>
                                                {{$value->getAccount()}}
                                            </td>      
                                            <td>                                              
                                                <a  class="btn btn-info" href="{{route('email.show',$value->id)}}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a  class="btn btn-warning" href="{{route('email.edit',$value->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <div style="display: inline-table;">    
                                                    {!! Form::open(['route' => ['email.destroy',$value->id],'method'=>'DELETE']) !!}
                                                    <button type="submit"  class="btn btn-danger">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                                    
                                </tbody>
                                @else
                                    <div class="page-not">
                                        <p align="center">   
                                            Item not found !!!
                                        </p>
                                    </div>
                                    @endif
                            </table>
                        </div>
                    </div>
                    <div class="pagination-admin">                        
                        {{$emails->links()}}
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