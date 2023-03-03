<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'category_translation';
    protected $primaryKey = 'category_translation_id';
    protected $fillable =
        [
            'category_id', 'title', 'description', 'language'
        ];

    public $timestamps = false;

//    /**
//     * @return BelongsTo
//     */
//    public function category(): BelongsTo
//    {
//        return $this->belongsTo(Category::class, 'category_id');
//    }

}
