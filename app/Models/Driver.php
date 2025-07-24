<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver'; // If your table is actually named 'driver', this is correct

    protected $fillable = [
        'user_id',
        'qr_code',
        'position',
        'department',
        'driver_license',
    ];

    // ✅ Relationship to user_info
    public function user()
    {
        return $this->belongsTo(UserInfo::class, 'user_id');
    }
}
