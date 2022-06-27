<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates=['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');

    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }



    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
        static::updating(function ($model) {
            $model->user_id = Auth::id();
        });

    }
}
