@extends('layouts.app');


@section('content')
    <h1>edit</h1>


    <div class="container">
        <h1>create Comics</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <h3>stampo errori</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $project->name) }}" placeholder="name">
                @error('title')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client_name" class="form-label">client_name</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name"
                    name="client_name" value="{{ old('client_name', $project->client_name) }}" placeholder="client_name">
                @error('client_name')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">cover image</label>
                <input type="file" onchange="showImage(event)"
                    class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image"
                    value="{{ old('cover_image', $project->price) }}" placeholder="cover_image">
                <div class="image mt-2">
                    <img width="75" id="output-image"
                        src="{{ $project->cover_image ? asset('storage/' . $project->cover_image) : 'https://img.freepik.com/free-icon/user_318-790139.jpg?w=2000' }}">
                </div>
                @error('cover_image')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">cateorie</label>
                <select class="form-select" name="category_id" aria-label="Default select example">
                    <option value="">Selezionare una categoria</option>
                    @foreach ($categories as $category)
                        <option @if ($category->id == old('category_id')) selected @endif value="{{ $category->id }}">
                            {{ $category->type }}</option>
                    @endforeach
                </select>

            </div>

            <div class="mb-3">
                <label for="summary" class="form-label">description</label>
                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3">{{ old('summary', $project->description) }}</textarea>
                @error('summary')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-5">Invia</button>
        </form>
    </div>

    <script>
        function showImage(event) {

            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
            console.log(tagImage.src);
        }
    </script>
@endsection
