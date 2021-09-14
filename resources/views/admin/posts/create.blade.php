@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Aggiungi un Post</h2>
    <form action="{{ route('admin.posts.store') }}" method="post" class="w-50">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label d-block">Titolo</label>
            <input class="w-100 form-control 
            @error('title') 
            is-invalid 
            @enderror" type="text" name="title" id="title" aria-describedby="emailHelp" value="{{ old('title')}}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="content" class="form-control 
            @error('content') 
            is-invalid 
            @enderror" id="description">{{ old('content') }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection