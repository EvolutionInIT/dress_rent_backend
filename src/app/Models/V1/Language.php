<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
    protected $primaryKey = 'language_id';

    protected $fillable = ['title', 'title_native', 'code', 'position', 'enabled'];
}
