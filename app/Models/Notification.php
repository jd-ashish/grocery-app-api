<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notification";

    protected $fillable = [
        "user_id", "title", "description", "img", "type", "status", "created_at", "updated_at"
    ];
}
