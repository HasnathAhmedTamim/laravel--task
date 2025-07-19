<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Task Model
 * 
 * Represents a task in the task management system with completion tracking.
 * This model handles task creation, status updates, and retrieval of pending tasks.
 * 
 * @property int $id Primary key
 * @property string $title Task title/description
 * @property bool $is_completed Completion status (false by default)
 * @property \Carbon\Carbon $created_at Creation timestamp
 * @property \Carbon\Carbon $updated_at Last update timestamp
 */
class Task extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     * 
     * These fields can be filled using create() or fill() methods.
     * 
     * @var array<int, string>
     */
    protected $fillable = ['title', 'is_completed'];
}
