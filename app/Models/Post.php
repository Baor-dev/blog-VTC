<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory; // Enables Laravel factory for testing
    
    protected $fillable = [
        'title',
        'short_description',
        'content',
        'banner_image',
        'gallery_images',
        'status',
        'user_id',
    ];

    protected $casts = [
        'gallery_images' => 'array', // Store gallery images as JSON
    ];

    /**
     * Get the author of the post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}