@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <thead class="mb-4">

                <tr >
                    <th scope="col"> # </th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Azioni</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td ">{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->content}}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post->id) }}"" class="btn btn-warning w-100">Edit</a>
                        <form action="" method="post" class="w-100 mt-2">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>

                    </td>
                </tr>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ route('admin.posts.index') }} " class="btn btn-primary">Torna indietro</a>
        </div>

    </div>

@endsection