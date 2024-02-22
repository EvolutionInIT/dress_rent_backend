<?php

namespace App\Models\V1;

use App\Models\Traits\V1\TranslationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use TranslationTrait;

    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = ['title', 'description', 'category_id'];

    public $timestamps = false;

    /**
     * @return HasManyThrough
     */
    public function photos(): HasManyThrough
    {
        return
            $this
                //->hasManyThrough(Photo::class,  DressCategory::class,'category_id', 'dress_id', "category_id", "dress_id");
                ->hasManyThrough(Photo::class, Dress::class, 'dress_id', 'dress_id', "dress_id", "dress_id");
    }
}
