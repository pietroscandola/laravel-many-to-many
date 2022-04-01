@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>{{ $post->content }}</p>
    <div>
        <time>Creato il: {{ $post->created_at }}</time>
    </div>
    @if ($post->tags)
        <div>
            <span>Tags: </span>
            @foreach ($post->tags as $tag)
                <span>{{ $tag->label }}, </span>
            @endforeach

        </div>
    @endif
    <br>
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->slug }}" class="img-fluid" width="250">
    @endif

    <hr>
    <div class="d-flex align-items-center justify-content-end">
        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" id='delete_form'>
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger mr-3"><i class="fa-solid fa-trash"></i> Elimina</button>
        </form>
        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning  mr-3">
            <i class="fa-solid fa-pencil"></i>
            Modifica
        </a>
        <a href=" {{ route('admin.posts.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-rotate-left"></i>
            Indietro
        </a>
    </div>
@endsection

@section('scripts')
    <script>
        const deleteForm = document.getElementById('delete_form')
        deleteForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const accept = confirm('Sei sicuro di eliminare questo post?')
            if (accept) e.target.submit();
        })
    </script>
@endsection
