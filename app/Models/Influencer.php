<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    use HasFactory;
    protected $table = 'influencer';
    protected $fillable = ['title', 'subscribe', 'facebook', 'twitter', 'youtube', 'instagram', 'icon', 'image', 'status', 'created_by', 'updated_by'];
 
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
