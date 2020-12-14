@extends('layouts.backend')
@section('title')
    {{'Control Panel'}}
@stop
@section('content')
    <!-- page content -->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
                <!-- Navbar Search-->
                    <form class="d-none d-md-inline-block form-inline ml-auto" action="{{ route('accountsearch') }}" method="GET">
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
                    <i class="fas fa-table mr-1"></i>User accounts
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10px">№</th>
                                    <th>Account</th>
                                    <th>Phone</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                             @if (count($accounts)>0)
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($accounts as $value)
                                <tr>
                                    <td>@php echo $i++ @endphp</td>
                                    <td>{{$value->name}}</td>
                                    @foreach($value->getPhone($value->id) as $val)
                                    <hr>
                                        <td>{{$val->number}}</td>
                                    </hr>
                                     @endforeach
                                     @foreach($value->getEmail($value->id) as $val)
                                    <hr>
                                        <td>{{$val->email_name}}</td>
                                    </hr>
                                     @endforeach
                                    <td>{{($value->status!=0)?'On':'Off'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            @else
                                <div class="page-not">
                                    <p align="center">                         
                                        Bu bo'limda hali ma'lumot saqlanmagan !!!
                                    </p>
                                </div>
                            @endif
                        </table>
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
@stop