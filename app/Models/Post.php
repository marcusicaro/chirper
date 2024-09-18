<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it follows Laravel's naming convention)
    protected $table = 'posts';

    // Define the fillable attributes
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // Define any relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}