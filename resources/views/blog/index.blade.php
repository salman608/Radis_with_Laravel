@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Execution Time: {{ $execution_time }}</h3>
            @foreach ($blogs as $blog )
                
           
            <div class="card mb-3">
                <div class="card-body">
                   <h1>{{ $blog->title }}</h1>
                   <p>{{ $blog->description }}</p>
                   <button class="btn btn-success btm-sm">Edit</button>
                <button class="btn btn-danger btm-sm">Delete</button>
                </div>
                
            </div>
             @endforeach
        </div>
    </div>
</div>
@endsection