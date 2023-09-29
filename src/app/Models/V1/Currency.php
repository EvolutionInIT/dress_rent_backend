<?php

namespace App\Models\V1;

use App\Models\Traits\V1\HelperTrait;
use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory, TranslationTrait, HelperTrait;

    protected $table = 'currency';
    protected $primaryKey = 'currency_id';

    protected $fillable = ['code', 'symbol', 'iban_code', 'enabled'];
}
