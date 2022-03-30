@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if ($post->exists)
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST">
@endif

@csrf
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="title">Titolo Post</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                value="{{ old('title', $post->title) }}" placeholder="Titolo">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
    </div>
    <div class="col-4">
        <label for="category">Categoria</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category">
            <option value="">-</option>
            @foreach ($categories as $category)
                <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                    {{ $category->label }}
                </option>
            @endforeach
        </select>
        @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5"
                placeholder="Contenuto">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-10">
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                value="{{ old('image', $post->image) }}" placeholder="url immagine">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-2">
        <img src="{{ old('image', $post->image) }} ?? https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"
            class="img-fluid" id="preview">
    </div>
    <div class="col-12 d-flex my-2">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="is_published" name="is_published"
                {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_published">Pubblicato</label>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success">
    <i class="fa-solid fa-floppy-disk mr-2"></i>
    Salva
</button>

</form>
