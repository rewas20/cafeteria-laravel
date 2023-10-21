@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-info table-striped">
        <tr>
            <th>Category</th>
            <th>Explore</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        @foreach($categories as $category)
        <tr>
            <td> {{$category->name}} </td>
            <td><a href="{{route('categories.show', $category->id)}}" class="btn btn-primary">Show Category</a></td>
            <td><a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning">Edit</a></td>
            <td>
                <form action="{{route('categories.destroy', $category->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete Category: {{$category->name}}?')">
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

    <div>
        <a href="{{route('categories.create')}}" class="btn btn-primary mt-5">Add New Category</a>
    </div>

</div>
{{$categories->links('pagination::bootstrap-5')}}
@endsection