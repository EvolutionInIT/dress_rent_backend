<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DressTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dress_translation';
    protected $primaryKey = 'dress_translation_id';
    protected $fillable =
        [
            'dress_id', 'title', 'description', 'language'
        ];

    public $timestamps = false;
}
