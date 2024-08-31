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

   
<div class="col-md-9">
    <div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Compose New Message</h3>
    </div>
    
    <form action="{{ route('messages') }}" method="post">
        @csrf
    <div class="card-body">
    <div class="form-group">
    <input class="form-control" placeholder="To:">
    </div>
    <div class="form-group">
    <input class="form-control" placeholder="Subject:">
    </div>
    <div class="form-group">
        <x-form.input id="message" name="message" label="Message" />
    </div>
    <div class="form-group">
        <input type="hidden" name="recipient_id" value="1" />
    </div>
   
    <button type="submit" class="btn btn-primary"> Send</button>
    </div>
    
    </div>
</form>
    </div>
    
</div>
    
</div>
    </section>
                
    </div>
@endsection

@section('js')

@endsection

