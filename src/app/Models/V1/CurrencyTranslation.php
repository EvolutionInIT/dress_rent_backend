<?php

namespace App\Models\V1;

use App\Models\Traits\V1\HelperTrait;
use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyTranslation extends Model
{
    use HasFactory, TranslationTrait, HelperTrait;

    protected $table = 'currency_translation';
    protected $primaryKey = 'currency_translation_id';

    protected $fillable = ['title', 'language'];
}
