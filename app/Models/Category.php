<?php

namespace App\Models;

use App\Models\project\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    // for paginate count in the same page
    protected $perPage = 2;


    protected $fillable = ['name' , 'description' , 'slug' , 'parent_id' , 'art_path'];

    protected $hidden = [
        'created_at' , 'updated_at'
    ];
    public function projects()
    {
        return $this->hasMany(Project::class , 'category_id' , 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id' , 'id')
                    ->withDefault([
                        'name' => 'no name',
                    ]);
    } 
    
}
