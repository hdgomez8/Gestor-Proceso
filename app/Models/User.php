<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // protected $dateFormat='Y-m-d';
    // protected $table = 'dbo.ADMUSR';
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = false;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'AUsrId',
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function getNameAttribute($value)
    // {
    //     return ucfirst($value);
    // }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->username;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function pedidos(){
        return $this->belongsTo(Pedidos::class);
    }
    // public function fromDateTime($value)
    // {
    //     return User::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s');
    // }
}
