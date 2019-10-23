@extends('layouts.front')

@section('content')

    <div class="d-flex justify-content-between">
        <div class="p-2">
            <h2>Last entries</h2>
        </div>
    </div>

    @include ('posts.list')
@endsection
