<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function students() {
        return $this->belongsToMany(User::class, 'borrowed_books')->withPivot('borrowed_at', 'return_by');
    }
}
