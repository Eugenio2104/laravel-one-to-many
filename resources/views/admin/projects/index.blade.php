@extends('layouts.app');


@section('content')
    <div class="my-container">
        <div class="p-3">
            <h1>dash</h1>
            <a class="btn btn-success" href="{{ route('admin.projects.create') }}">New Project</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">Type</th>
                    <th scope="col">client_name</th>
                    <th scope="col">summary</th>
                    <th scope="col">azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <th><img class="thumb"
                                src="{{ $project->cover_image ? asset('storage/' . $project->cover_image) : 'https://img.freepik.com/free-icon/user_318-790139.jpg?w=2000' }}"
                                alt=""></th>
                        <td>{{ $project->name }} </td>
                        <td><span class="badge text-bg-warning"> {{ $project->category->type }}</span> </td>
                        <td>{{ $project->client_name }}</td>
                        <td>{{ $project->summary }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('admin.projects.show', $project) }}"><i
                                    class="fa-regular fa-eye"></i></a>
                            <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="d-inline btn btn-danger" href=""><i
                                        class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
