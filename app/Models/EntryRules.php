<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryRules extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

   /*  public function used_entry_rules(){
        return $this->hasMany(Used_entry_rules::class);
    } */
}
