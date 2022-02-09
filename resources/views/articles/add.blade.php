@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <div class="alert alert-warning">
        <ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
    @endif
   <form method="POST">
       @csrf
    <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="mb-3">
        <label for="body">Body</label>
     <textarea name="body" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="category">Category</label>
        <select name="category_id" id="" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category['id'] }}" >{{ $category['name']}}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Add Article" class="btn btn-primary">
   </form>
</div>
@endsection
