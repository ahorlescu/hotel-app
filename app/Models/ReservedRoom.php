<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedRoom extends Model
{
    use HasFactory;

    protected $fillable = ['reserved_from', 'reserved_till', 'room_id'];

}
