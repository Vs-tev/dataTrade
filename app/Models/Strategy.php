<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    use HasFactory;

    protected $fillable = ['name, description', 'img_strategy'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trade(){
        return $this->hasMany(Trade::class);
    }
}
