@extends('dashboard.main')

@section('title')
	Create Page
@endsection

@section('css')


@endsection


@section('bodyName')
Create Category 
@endsection



@section('content')
    

<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                    <li> {{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store')}}" method="post">
        @csrf

        @include('categories._form')

    </form>
</div>


@endsection


@section('js')

@endsection