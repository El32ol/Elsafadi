@extends('dashboard.main')

@section('title')
	Tha Main Projects
@endsection

@section('css')


@endsection


@section('bodyName')
All Projectes  <small> <a href="#"> Create </a></small>
@endsection

@section('content')

        <div class="container">
    <form action="{{ route ('clients.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        @include('project._form')

    </form>
           
@endsection

@section('js')

@endsection

