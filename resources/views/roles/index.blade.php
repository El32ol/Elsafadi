@extends('dashboard.main')

@section('title')
	Roles Page
@endsection

@section('css')


@endsection


@section('bodyName')
Roles  <small> <a href="{{ route('roles.create')}}"> Create </a></small>
@endsection

@section('content')
        <div class="table-responsive">
        
            <x-flash-message />

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td><a href="{{ route('roles.show' , $role->id)}}"> {{  $role->name }}  </a></td>
                        <td>{{ $role->slug }} </td>
                        <td>{{ $role->parent_name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td> <a href="{{ route('roles.edit' , $role->id)}}" class="btn btn-sm btn-dark"> Edit </a>
                        </td>
                        <td>
                            <form action="{{ route('roles.destroy' , $role->id)}}" method="post">
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
 
        {{ $roles->links() }}

@endsection

@section('js')

@endsection

