<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_equity',
        'currency',
        'user_id',
        'is_active'
    ];
    protected $appends=['published'];
    public function getPublishedAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
        //this bind published with getPublishedAttribute() and return 'created_at' with diffForHumans(). used in vue to output readable date 
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeIsactive($query){
        return $query->where('is_active', 1); //return only active
    }
}
