<?php

namespace App\Models\freelancer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'user_id';

    protected $fillable = ['first_name' , 'image_path' , 'description' 
    , 'last_name' ,'salary' , 'birthday' ,'gender','verified' ];

    // protected $casts = [
    //     'image_path' => 'string',
    // ];
    
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    // public function getProfileImage()
    // {
    //     if($this->)
    //     {

    //     }
    // }
}
