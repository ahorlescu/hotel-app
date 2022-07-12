<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'room_type_id', 'available_from', 'available_till'];

    public function services(){
        return $this->belongsToMany(Service::class);
    }

    public function room_types(){
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }

    public function reserved_rooms(){
        return $this->hasMany(ReservedRoom::class);
    }
}
