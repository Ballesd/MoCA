<?php

namespace App\Models;
use App\Traits\UUID;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Moca extends Model
{
    use HasFactory;
    use UUID;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
