<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventUsers extends Model
{
    use HasFactory;
    protected $table = 'event_users';
    protected $fillable = ['name', 'email', 'telephone', 'post_id'];

    public function event()
    {
        return $this->belongsTo(Posts::class);
    }
}
