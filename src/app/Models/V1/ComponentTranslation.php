<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComponentTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'component_translation';
    protected $primaryKey = 'component_translation_id';
    protected $fillable =
        [
            'title', 'description', 'language'
        ];

    public $timestamps = false;
}
