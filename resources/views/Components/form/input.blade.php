   @props([ 'id' , 'label' , 'name' , 'type' => 'text' , 'value' => '' , ])

   <label for="{{ $id }}">{{ $label }}</label>
    <input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $id }}" 
    value="{{ old($name , $value) }}"

     {{ $attributes->class
     (['form-control', 'is-invalid'=>$errors->has($name)]) }}
     
     >
     @error($name)
        <p class="invalid-feedback"> {{ $message }} </p>
    @enderror
