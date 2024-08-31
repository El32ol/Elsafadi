@extends('dashboard.main')

@section('title')
	Tha Main Projects
@endsection

@section('css')


@endsection


@section('bodyName')
All Projectes  <small> <a href="{{ route ('clients.create') }}"> Create </a></small>
@endsection

@section('content')
        <div class="table-responsive">
        
            <x-flash-message />

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Budget</th>
                        <th>Tags</th>
                        <th>File Path</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td> <a href="{{ route('clients.show', $project->id) }}">{{ $project->title }}</a></td>
                        <td>{{ $project->title }} / {{ $project->category->name ?? 'asa'}} </td> 
                        <td>{{ $project->type }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->budget }}</td>
                        <td> @foreach ( $project->tags as $name )
                            {{ $name->name }}
                            @endforeach </td> 
                        {{-- <td> 
                            <ul>
                                @foreach ($project->attachments as $file )
                                <li>{{ $file }}</li>
                                @endforeach
                            </ul> --}}
                             {{-- {{$project->attachments[0]}} --}}
                        </td>
                        <td> <a href="{{ route('clients.edit' , $project->id)}}" class="btn btn-sm btn-dark"> Edit </a>
                        </td>
                        <td>
                            <form action="{{ route('clients.destroy' , $project->id)}}" method="post">
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
 
        {{-- {{ $projects->links() }} --}}

@endsection

@section('js')

@endsection

