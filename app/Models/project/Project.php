<?php

namespace App\Models\project;

use App\Models\tag;
use App\Models\User;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Proposal;
use Illuminate\Support\Str;
use App\Models\Tag as ModelsTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    const TYPE_FIXED = 'fixed';
    const TYPE_HOURLY = 'hourly';

    use HasFactory;

    protected $fillable = ['title' , 'attachments' ,   'description' , 'status' , 'category_id' , 'type' , 'budget'];
   
    protected $casts = [
        'attachments' => 'json', 
        'budget' => 'float',
    ];
   

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }

    public static function types()
    {
        return [
            self::TYPE_FIXED => 'Fixed',
            self::TYPE_HOURLY => 'Hourly',
        ];
    }

    //global scope 
    // i can use this like filter
    // protected static function booted()
    // {
    //     static::addGlobalScope('active' , function(Builder $builder){
    //         $builder->where('status' , '=' , 'active');
    //     });
    // }
    // i can use this for validated
    // public function scopeClosed(Builder $builder)
    // {
    //         $builder->where('status' , 'closed');
    // }

    // public function scopeHourly(Builder $builder)
    // {
    //     $builder->where('type' , 'hourly');
    // }

    // for filter in general
    // public function scopeFilter(Builder $builder , $filters = [])
    // {
    //     $filters =array_merge([
    //         'type' => null,
    //         'status' => null,
    //         'budget_min' => null,
    //         'budget_max' => null,
    //     ] , $filters);

    //     if($filters['type'])
    //     {
    //         $builder->where('type' , '=' , $filters['type']);
    //     }

        // $builder->when($filters['status'] , function( $builder , $value){
        //     $builder->where('status' ,'=' , $value);
        // });


        // $builder->when($filters['budget_max'] , function( $builder , $value){
        //     $builder->where('budget_max' ,'<=' , $value);
        // });
    // }
    
    // this for any project has api system for hidden the  data
    protected $hidden = [
        'updated_at'
    ];
    // this for append or add something as accessory
    protected $appends = [
        'type_name',
    ];

    public function getTypeNameAttribute()
    {
        return ucfirst($this->type);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'project_tag',
            'project_id',
            'tag_id',
            'id',
            'id',
        );
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function contracts()
    {
        return $this->hasNamedScope(Contract::class);
    }

    public function proposedFreeLance()
    {
        return $this->belongsToMany(
                User::class,
                'proposals',
                'project_id',
                'freelancer_id',
            )->withPivot([
                  'description' , 'cost' , 'duration' , 'duration_unit' , 'status'
            ]);
    }

    public function contractedFreeLance()
    {
        return $this->belongsToMany(
                User::class,
                'contracts',
                'project_id',
                'freelancer_id',
            )->withPivot([
                'proposal_id' ,'cost' ,'type',
                 'start_on' ,'end_on' , 'completed_on'  , 'hours', 'status'
            ]);
    }

    public function syncTags(array $tags)
    {
        $tag_id=[];
        foreach($tags as $tag_name)
        {
            $tag = Tag::firstOrCreate(
                ['slug' => Str::slug($tag_name)],
                ['name' => $tag_name],
            );
            $tag_id[] = $tag->id;
        }
        $this->tags()->sync($tag_id);

    }
}
