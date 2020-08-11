<?php


namespace App\Services\RegistryItem\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistryItemUrl extends Model
{
    use  SoftDeletes;

    protected $table = 'registry_items_urls';

    protected $fillable = [
        'name',
        'description',
        'registry_item_id',
        'url',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];

}
