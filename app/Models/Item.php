<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'brand',
        'price',
        'condition_id',
        'description',
        'condition',
        'image',
        'is_sold',
    ];

    
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function user()
    {
    return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function comments() { return $this->hasMany(Comment::class); }

    public function likes() { return $this->hasMany(Like::class); }

    public function orders() { return $this->hasMany(Order::class); }

    public function condition(){ return $this->belongsTo(Condition::class); }
    

}
