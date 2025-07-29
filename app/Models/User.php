<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function post():HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function onepost():HasOne
    {
        return $this->post()->one()->ofMany('updated_at');
    }


/*
    public function onepost():HasOne
    {
        return $this->hasOne(Post::class)->latestOfMany();
        return $this->hasOne(Post::class)->oldestOfMany();
        return $this->hasOne(Post::class)->ofMany();

        // This gives the one latest data of many based on the primary key of post model like in 1, 2, 3 latest is 3.
        // Also note that for latest and oldest based on the if, we have direct method as latestOfMany and oldestOfMany()
    }
*/

}
