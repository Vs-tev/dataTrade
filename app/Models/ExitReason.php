<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExitReason extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

    public function trade(){
        return $this->hasMany(Trade::class);
    }
}
