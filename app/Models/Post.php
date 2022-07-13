<?php

namespace App\Models;

use App\Http\Traits\PhotoTrait;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Qirolab\Laravel\Reactions\Traits\Reactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Qirolab\Laravel\Reactions\Contracts\ReactableInterface;

class Post extends Model implements ReactableInterface
{
    use HasFactory, Reactable, PhotoTrait;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 1);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
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
