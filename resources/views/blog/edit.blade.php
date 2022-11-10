@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                
           
            <div class="card mb-3">
                <div class="card-body">
                   <form action="{{ route('blog.update', $blog->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                     <input id="name" type="text" class="form-control mb-2" name="title" value="{{ $blog->title }}" autofocus>
                     <textarea name="description" id="" cols="30" rows="10" class="form-control">
                        {{ $blog->description }}
                     </textarea>
                     <button type="submit" class="btn btn-primary ml-3">Submit</button>
                   </form>
                
                </div>
                
            </div>
           
        </div>
    </div>
</div>
@endsection