<?php

namespace App\Models\CronJobModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderJob extends Model
{
    use HasFactory;
    protected $table = "order_job";
}
