@if(Session::has('success')) 
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif
 @if(Session::has('info')) 
<div class="alert alert-c">
    {{ Session::get('Session::get') }}
</div>
@endif
@if(Session::has('warning')) 
<div class="alert alert-warning">
    {{ Session::get('warning') }}
</div>
@endif
@if(Session::has('error')) 
<div class="alert alert-danger">
    {{ Session::get('error') }}
</div>
@endif 