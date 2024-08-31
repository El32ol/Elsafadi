@extends('dashboard.main')

@section('title')
	{{ $category->name . ' Info' }}
@endsection

@section('css')


@endsection


@section('bodyName')
{{ 'Show ' . $category->name . ' Category' }}
@endsection



@section('content')
        <div class="table-responsive">
         
            <!-- <h1 class="bm-3"> {{ $title ?? "aaa";}}</h1> -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent ID</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
                <td>{{ $category->id}}</td>
                <td> {{ $category->name}} </td>
                <td>{{ $category->slug}}</td>
                <td>{{ $category->parent_id}}</td>
                <td>{{ $category->created_at}}</td>
            </tr>
            
        </tbody>
    </table>
    </div>

    @endsection


    @section('js')
    
    @endsection