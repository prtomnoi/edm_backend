<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'detail', 'image', 'status', 'provider_id', 'created_by', 'updated_by'];

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
