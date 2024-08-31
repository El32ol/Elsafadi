@extends('dashboard.main')

@section('title')
	Create Page
@endsection

@section('css')


@endsection


@section('bodyName')
{{ 'Edit Category ' . $category->name }}
@endsection



@section('content')
    
        
        <form action="{{ route('categories.update' , $category->id)}}" method="post">

            @method('put')
            @csrf

            @include('categories._form')

        </form>


    @endsection


    @section('js')
    
    @endsection
