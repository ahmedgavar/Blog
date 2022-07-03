<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Qirolab\Laravel\Reactions\Traits\Reactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;

class Post extends Model implements ReactableInterface
{
    use HasFactory,Reactable;

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
