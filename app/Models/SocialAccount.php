<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;


class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_name',
        'provider_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}