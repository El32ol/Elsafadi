@extends('dashboard.main')

@section('title')
	Tha Main Projects
@endsection

@section('css')


@endsection


@section('bodyName')
All Projectes  <a href="#"></a>
@endsection

@section('content')
        <div class="table-responsive">
        
            <x-flash-message />

                    @foreach ($proposals as $proposal)
            <h3> {{'Project Title => ' . $proposal->project->title  }} </h3>
            <h3> {{'Project Title => ' . $proposal->description  }} </h3>

            <div class="buttons-to-right-always-visible">
                {{-- <a href="{{ route('clients.edit' , $proposal->id)}}" class="btn btn-sm btn-dark"> Edit </a> --}}
            </div>
                            {{-- <form action="{{ route('clients.destroy' , $proposal->id)}}" method="post">
                                @method('delete') 
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"> Delete </button>
                            </form> --}}

                    @endforeach
            </table>
        </div>
 
        {{-- {{ $categories->links() }} --}}

@endsection

@section('js')

@endsection

