@extends('layouts.app')
@section('content')
    <header>
        <h1>
            Lista Posts
        </h1>
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
                <th scope="row">{{$post->id}}</th>
                <th>{{$post->title}}</th>
                <th>{{$post->slug}}</th>
                <th>{{$post->created_at}}</th>
                <th>{{$post->updated_at}}</th>
                <td>
                  <a class="btn-btn-sm btn-primary p-1" href="{{route('admin.posts.show',$post)}}">
                    <i class="fa-solid fa-eye mr-2"></i> Vedi
                  </a>
                </td>
              </tr>
          @empty
            <tr><td colspan="6"><h3 class="text-center">Nessun Post</h3></td></tr>  
          @endforelse
        </tbody>
      </table>
@endsection
