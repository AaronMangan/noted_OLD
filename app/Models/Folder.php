<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'user_id'
    ];

    /**
     * Returns the pages belonging to this folder.
     *
     * @return void
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
