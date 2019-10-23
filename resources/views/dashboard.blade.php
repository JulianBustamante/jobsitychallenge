@extends('layouts.app')

@section('content')
<div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row justify-content-md-center">
                <div class="col-sm-6 col-xl-4">
                    @can('read-posts')
                        <posts-count></posts-count>
                    @endcan
                </div>
                <div class="col-sm-6 col-xl-4">
                    @can('read-users')
                        <users-count></users-count>
                    @endcan
                </div>
                <div class="col-sm-6 col-xl-4">
                    @can('read-roles')
                        <roles-count></roles-count>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
