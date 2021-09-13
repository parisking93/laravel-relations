@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Aggiungi un Post</h2>
    <form action="{{ route('admin.posts.store') }}" method="post" class="w-50">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label d-block">Titolo</label>
            <input class="w-100" type="text" name="title" id="title" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="content" class="form-control" id="description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection