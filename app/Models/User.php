<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Page;
use App\Models\Folder;
use App\Models\Template;
use App\Models\Traits\FindByProperty;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use FindByProperty;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function shared()
    {
        return \App\Models\Page::whereJsonContains('shared_with_users', $this->id)->where('private', false)->get();
    }
}
