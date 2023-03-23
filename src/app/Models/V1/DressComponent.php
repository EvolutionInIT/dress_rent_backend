<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressComponent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_component';
    protected $primaryKey = 'dress_component_id';
    protected $fillable = ['dress_id', 'component_id'];

    public $timestamps = false;

}
