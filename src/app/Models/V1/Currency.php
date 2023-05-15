<?php

namespace App\Models\V1;

use App\Models\Traits\V1\HelperTrait;
use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Traits
    use TranslationTrait;
    use HelperTrait;

    protected $table = 'currency';
    protected $primaryKey = 'currency_id';

    protected $fillable = ['title', 'code', 'symbol'];
}
