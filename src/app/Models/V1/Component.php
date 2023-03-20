<?php

namespace App\Models\V1;

use App\Models\Traits\V1\HelperTrait;
use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Traits
    use TranslationTrait;
    use HelperTrait;

    protected $table = 'component';
    protected $primaryKey = 'component_id';
    protected $fillable =
        [
            'component_id', 'title', 'description', 'quantity', 'price'
        ];

    public $timestamps = false;

}
