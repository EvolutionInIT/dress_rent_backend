<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUSES = [
        'NEW' => 'new',
        'CANCELED' => 'canceled',
        'APPROVED' => 'approved',
        'UNAPPROVED' => 'unapproved',
    ];

    protected $table = 'booking';
    protected $primaryKey = 'booking_id';
    protected $fillable = ['dress_id', 'date', 'status'];

    protected $hidden = [
        'deleted_at'
    ];

    public $timestamps = false;


}
