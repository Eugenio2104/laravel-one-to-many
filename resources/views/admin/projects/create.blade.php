@extends('layouts.app');



@section('content')
    <div class="container">


        <h1>create Projects</h1>

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

        <div>
            <a class="btn btn-success" href="{{ route('admin.projects.index') }}">torna index</a>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="name project">
                @error('name')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="client_name" class="form-label">client name</label>
                <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name"
                    name="client_name" value="{{ old('client_name') }}" placeholder="client name">
                @error('client_name')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">cover image</label>
                <input onchange="showImage(event)" type="file"
                    class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image"
                    value="{{ old('cover_image') }}" placeholder="cover image">
                <div class="image mt-2">
                    <img width="75" id="output-image">
                </div>
                @error('cover_image')
                    <div class="invalid-feedback">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="summary" class="form-label">summary</label>
                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3">{{ old('summary') }}</textarea>
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
