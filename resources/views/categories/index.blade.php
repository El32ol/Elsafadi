@extends('dashboard.main')

@section('title')
	Tha Main Page
@endsection

@section('css')


@endsection


@section('bodyName')
All Category  <small> <a href="{{ route('categories.create')}}"> Create </a></small>
@endsection

@section('content')
        <div class="table-responsive">
        
            <x-flash-message />

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent ID</th>
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('categories.show' , $category->id)}}"> {{  $category->name }}  </a></td>
                        <td>{{ $category->slug }} </td>
                        <td>{{ $category->parent_name }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td> <a href="{{ route('categories.edit' , $category->id)}}" class="btn btn-sm btn-dark"> Edit </a>
                        </td>
                        <td>
                            <form action="{{ route('categories.destroy' , $category->id)}}" method="post">
                                @method('delete') 
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"> Delete </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
 
        {{ $categories->links() }}

@endsection

@section('js')

@endsection

