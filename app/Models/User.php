<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\project\Project;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use App\Models\freelancer\Freelancer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function freeLancer()
    {
        return $this->hasOne(Freelancer::class , 'user_id' , 'id')
                    ->withDefault();
    }
    public function projects()
    {
        return $this->hasMany(Project::class , 'user_id' , 'id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class , 'freelancer_id' , 'id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class , 'freelancer_id' , 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class , 'role_user');
    }

    public function proposedProjects()
    {
        return $this->belongsToMany(
            Project::class,
            'proposals',
            'freelancer_id',
            'project_id'
        )->withPivot([
            'description' , 'cost' , 'duration' , 'duration_unit' , 'status'
        ]);
    }

    public function contractedProjects()
    {
        return $this->belongsToMany(
            Project::class,
            'contracts',
            'freelancer_id',
            'project_id'
        )->withPivot([
            'proposal_id' ,'cost' ,'type',
             'start_on' ,'end_on' , 'completed_on'  , 'hours', 'status'
        ]);
    }
    
    //accessory 
    // $this->profile_image
    public function getProfileImageAttribute()
    {
        if($this->freeLancer->image_path)
        {
            return asset('storage/'. $this->freeLancer->image_path);
        }
        else{
            return asset('/storage/profiles/default.jpg');
        }
    }
    
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::upper($value);
    }   
    // function for email if we have input of email with other name like (email_ak)
    public function routeNotificationForEmail($notification = null)
    {
        return $this->email; // == default
        //if we have input of email with other name like (email_ak)
        // return $this->email_ak;
    }

    public function routeNotificationForVonage($notification = null)
    {
        // function for number if we have input of phone number with other name like (number_number)
        return  $this->mobile_number;// == default=>phone_number
    }
    //for custom channel
    public function routeNotificationForNepras($notification = null)
    {
        // function for number if we have input of phone number with other name like (number_number)
        return  $this->mobile_number;// == default=>phone_number
    }

    public function receivesBroadcastNotificationsOn ()
    {   // if this the name must be in chanel file and js 
        // return 'Notifications.' . $this->id;
        return 'App.Models.User.' . $this->id;
    }

    public function createToken(string $name, array $abilities = ['*'],  $fcm_device= null)
    {
        $plainTextToken = $this->generateTokenString();

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'fcm_device' =>$fcm_device,
            // 'expires_at' => $expiresAt,
        ]);
        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);

    }
}
