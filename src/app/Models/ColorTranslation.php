<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ColorTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'color_translation';
    protected $primaryKey = 'color_translation_id';
    protected $fillable =
        [
            'color_id', 'title', 'language'
        ];

    public $timestamps = false;
}
