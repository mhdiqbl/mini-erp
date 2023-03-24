<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $incrementing = false;

    protected $keyType = 'string';

    public function getCreatedAtMillis()
    {
        return Carbon::parse($this->created_at)->getTimeStamp() * 1000;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4();
        });
    }

    public function product()
    {
        $this->hasMany(Product::class, 'category_id', 'id');
    }
}
