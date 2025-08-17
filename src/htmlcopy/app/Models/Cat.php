<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    // SQLのWHERE句やモデル操作で使う主キー名をEloquentに教える
    protected $primaryKey = 'cat_id';    // ← 主キーをcat_idに

    // ルートモデルバインディングの時に使うカラム名をLaravelに教える（既定は'id'）
    public function getRouteKeyName()
    {
        return 'cat_id';                 // ← これが超重要
    }

    public function breedRel()
    {
        return $this->belongsTo(\App\Models\CatBreed::class, 'breed', 'breed_status');
    }

    protected $casts = ['gender' => \App\Enums\CatGender::class];
    
    public function images()
    {
        return $this->hasMany(\App\Models\CatImage::class, 'cat_id', 'cat_id')->orderBy('sort_order');
    }
    
    public function primaryImage()
    {
        return $this->hasOne(\App\Models\CatImage::class, 'cat_id', 'cat_id')->where('is_primary', true);
    }
}
