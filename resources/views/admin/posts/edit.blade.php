@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Modifica il Post</h2>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" class="w-50">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label d-block">Titolo</label>
            <input class="w-100" type="text" name="title" id="title" aria-describedby="emailHelp" value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea name="content" class="form-control" id="description">{{$post->content}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
</div>
@endsection