<?php

namespace App\Models;

use App\Models\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Traits
    use TranslationTrait;

    protected $table = 'color';
    protected $primaryKey = 'color_id';
    protected $fillable = ['color_id', 'color'];

    public $timestamps = false;
}
