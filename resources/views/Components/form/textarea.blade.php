   @props([ 'id' , 'label' , 'name' , 'value' => '' , ])

   <label for="{{ $id }}">{{ $label }}</label>
    <textarea  
    name="{{ $name }}" 
    id="{{ $id }}" 
    
    {{ $attributes->class
     (['form-control', 'is-invalid'=>$errors->has($name)]) }}
     
     >
     {{ old($name , $value) }}
    
   </textarea>
     @error($name)
        <p class="invalid-feedback"> {{ $message }} </p>
    @enderror
