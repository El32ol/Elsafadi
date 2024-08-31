<div class="form-group">
    <x-form.input id="title" label="Title" name="title" :value="$project->title" />
</div>


<div class="form-group">
    <x-form.select id="category_id" name="category_id" label="Category Id" :options="$categories" :selected="$project->category_id" />
</div>

<div class="form-group">
    <x-form.input id="tags" name="tags" label="Tags" :value="implode(',', $tags)" />
</div>

<div class="form-group">
    <x-form.select class="custom-select custom-select-lg mb-3" name="type" label="Type" :options="$types"
        :selected="$project->type" />
</div>

<div class="form-group">
    <x-form.textarea label="Description" name="description" id="description" :value="$project->description" />
</div>

<div class="form-group">
    <x-form.input id="budget" label="Budget" name="budget" :value="$project->budget" />
</div>

<div class="form-group">
    <input type="file" name="attachments[]" id="attachments" multiple>
</div>
@if (is_array($project->attachments))
    <div class="form-group">
        <ul>
            @foreach ($project->attachments as $file)
            <li> <a href="{{ asset ('storage/' . $file) }}">{{ $file }} </a></li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <button type="submit"class="btn btn-primary"> Save </button>
</div>

</div>
