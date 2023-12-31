<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $collection = 'items';
    protected $connection = 'mongodb';
}
