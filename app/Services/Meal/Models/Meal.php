<?php


namespace App\Services\Meal\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use  SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'gluten_free',
    ];

    protected $casts = [
        'id' => "integer",
        'slug' => 'string',
        'rehearsal' => 'integer',
    ];


    protected $hidden = ['deleted_at', 'deleted_by'];
}
