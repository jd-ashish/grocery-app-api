<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferExclusive extends Model
{
    use HasFactory;

    protected $table = "offer_exclusive";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
