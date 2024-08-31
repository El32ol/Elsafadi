@extends('dashboard.main')

@section('title')
	Show Page
@endsection

@section('css')


@endsection


@section('bodyName')
{{ 'Show ' . $project->title . ' Category ' }} {{ $project->category->name }} 
@endsection

@section('content')
        <div class="table-responsive">
        
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Budget</th>
                        <th>Status</th>
                   
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->category->name }}</td>
                        <td>{{ $project->type }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->budget }}</td>
                        <td>{{ $project->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
 
        {{-- {{ $categories->links() }} --}}

@endsection

@section('js')

@endsection

