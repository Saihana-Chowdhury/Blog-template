<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
use HasFactory;


protected $fillable = ['name', 'slug', 'description'];


// A category has many posts
public function posts()
{
return $this->hasMany(Post::class);
}


// Auto-generate slug if not provided
protected static function booted()
{
static::creating(function ($category) {
if (empty($category->slug)) {
$category->slug = Str::slug($category->name);
}
});


static::updating(function ($category) {
if ($category->isDirty('name') && empty($category->slug)) {
$category->slug = Str::slug($category->name);
}
});
}
}