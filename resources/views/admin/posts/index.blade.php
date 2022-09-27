@extends('layouts.app')
@section('content')
    <header class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista Posts</h1>
        <a class="btn btn-success" href="{{route('admin.posts.create')}}">
          <i class="fa-solid fa-plus mr-2"></i> Nuovo Post
        </a>
    </header>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il</th>
                <th scope="col">Modificato il</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <th>{{ $post->title }}</th>
                    <th>{{ $post->slug }}</th>
                    <th>{{ $post->created_at }}</th>
                    <th>{{ $post->updated_at }}</th>
                    <td class="d-flex justify-content-between">
                      <a class="btn btn-sm mr-2 btn-primary p-1" href="{{ route('admin.posts.show', $post) }}">
                        <i class="fa-solid fa-eye mr-2"></i> Vedi
                      </a>
                      <a class="btn btn-sm mr-2 btn-warning p-1" href="{{ route('admin.posts.edit', $post) }}">
                        <i class="fa-solid fa-pencil mr-2"></i> Modifica
                      </a>
                      <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger" type="submit">
                              <i class="fa-solid fa-trash mr-2"></i> Elimina
                          </button>
                      </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <h3 class="text-center">Nessun Post</h3>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
