<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'size';
    protected $primaryKey = 'size_id';
    protected $fillable = ['size_id', 'size'];

    public $timestamps = false;
}
