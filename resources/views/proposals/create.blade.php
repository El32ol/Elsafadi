@extends('dashboard.main')

@section('css')


@endsection


@section('bodyName')
Proposal 
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
    <h4> {{ 'Client Name =>  ' . $project->user->name }} </h4>
    <h4> {{ 'Project Title =>  ' . $project->title }} </h4>
    {{-- <h4> {{ 'Project Budget =>  ' . $project->budget }} </h4>
    <h4> {{ 'Project Type =>  ' . $project->type }} </h4> --}}
    <h4> {{ 'Project Created At =>  ' . $project->created_at->diffForHumans() }} </h4>
    
    <form action="{{ route('proposal.store' , $project->id)}}" method="post">
        @csrf
        <div class="form-group">
            <x-form.textarea id="description" label="Description" name="description" id="description" required="required"  />
        </div>
        <div class="form-group">
            <x-form.input  type="number" id="cost" label="Cost" name="cost" required="required"  />
        </div>
        <div class="form-group">
            <x-form.input type='number' id="duration" label="Duration" name="duration" required="required"  />
            <x-form.select id="duration_unit" label="Duration Unit" name="duration_unit" :options="$units"  />
        </div>

        <button type="submit" class="btn btn-primary"> Save </button>
    </form>
</div>


@endsection


@section('js')

@endsection