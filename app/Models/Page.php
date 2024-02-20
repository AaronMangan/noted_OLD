<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folder;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'private', 'shared_with_users'];

    protected $casts = [
        'shared_with_users' => 'array',
        'private' => 'bool',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->hasOne(Folder::class);
    }

    /**
     * Share this page with another user.
     *
     * @param integer $id
     * @return boolean
     */
    public function share(int $id): bool
    {
        $sharedWithUsers = $this->shared_with_users;
        $sharedWithUsers[] = $id;
        $sharedWithUsers = array_unique($sharedWithUsers);
        return $this->update(['shared_with_users' => $sharedWithUsers]);
    }
}
