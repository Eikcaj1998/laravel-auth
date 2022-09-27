<form action="{{ route('admin.posts.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                    required minlength="5" maxlength="50">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="content">contenuto</label>
                <textarea class="form-control" id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
            </div>
        </div>
        <div class="col-11">
            <div class="form-group">
                <label for="image">Immagine</label>
                <input type="url" class="form-control" id="image-field" name="image" value="{{ old('image') }}">
            </div>
        </div>
        <div class="col-1">
            <img id="preview" src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png" 
            alt="post image preview" class="img-fluid">
        </div>
    </div>
    <hr>
    <footer class="d-flex justify-content-between">
        <a href="{{ route('admin.posts.index') }}"class="btn btn-secondary">
            <i class="fa-solid fa-rotate-left mr-2"></i> Indietro
        </a>
        <button class="btn btn-success" id="button">
            <i class="fa-solid fa-floppy-disk mr-2"></i>
        </button>
    </footer>
</form>