<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post Model
 * 
 * Represents a blog post in the application with full CRUD capabilities.
 * This model handles blog post creation, retrieval, updating, and deletion.
 * 
 * @property int $id Primary key
 * @property string $title Post title
 * @property string $content Post content/body
 * @property \Carbon\Carbon $created_at Creation timestamp
 * @property \Carbon\Carbon $updated_at Last update timestamp
 */
class Post extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     * 
     * These fields can be filled using create() or fill() methods.
     * 
     * @var array<int, string>
     */
    protected $fillable = ['title', 'content'];
}
