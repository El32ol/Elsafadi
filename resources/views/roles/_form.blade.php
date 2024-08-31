<div class="form-group">
    <x-form.input value="{{ $category->name }}" class="form-control-lg" label="Category Name" id="name" name="name" />
</div>
<div class="form-group">
    <x-form.input :value=" $category->slug " label="Slug" id="slug" name="slug" />
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror"> {{ old('description' , $category->description) }}</textarea>
    @error('description')
        <p class="invalid-feedback" > {{ $message }} </p>
    @enderror
</div>
<div class="form-group">

    <x-form.select id='parent_id' name='parent_id' label='Parent ID' :options="$parents->pluck('name' , 'id')" :selected="$category->parent_id" />
    {{-- <label for="parent_id">Parent ID</label>
    <select type="text" name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @endif">
        <option value=""> No Category </option>

       @foreach ( $parents as $parent)
        <option value="{{ $parent->id }}" @if ($parent->id == old('parent_id' , $categories->parent_id ) ) selected @endif > 
                {{ $parent->name}} </option>
      @endforeach
        
    </select>
    @error('parent_id')
    <p class="invalid-feedback" > {{ $message }} </p>
    @enderror --}}
</div>

<div class="form-group">
    <label for="art_path">Art File</label>
    <input type="file" name="art_path" id="art_path" class="form-control @error('art_path') is-invalid @endif">
    @error('art_path')
    <p class="invalid-feedback" > {{ $message }} </p>
    @enderror
</div>

<div class="form-group">
    <button  type="submit" class="btn btn-primary">SAVE </button>
</div>