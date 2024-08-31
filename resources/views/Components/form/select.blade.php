  @props(['id'=>'' , 'label'=>'' , 'name' ,'options' => [] , 'selected'=>''])

@if (@isset($label))  
<label for="{{ $id }}">{{ $label }}</label>
@endif
  <select  
  name="{{ $name }}" 
  id="{{ $id }}" 
  {{ $attributes->class
  (['form-control', 'is-invalid'=>$errors->has($name)]) }}
  >
      <option></option>

     @foreach ($options as $value => $text)
      <option value="{{ $value }}" @if($value == old($name , $selected)) selected @endif> 
              {{ $text}} </option>
    @endforeach
      
  </select>
  @error('$name')
  <p class="invalid-feedback">{{ $message }}</p>
  @enderror

    
