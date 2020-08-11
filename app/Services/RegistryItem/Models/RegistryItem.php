<?php


namespace App\Services\RegistryItem\Models;


use App\Services\Party\Models\Party;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistryItem  extends Model
{
    use  SoftDeletes;

    protected $table = 'registry_items';

    protected $fillable = [
        'name',
        'description',
        'photo_src',
        'party_id',
        'claimed_at',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];


    public function registry_item_urls()
    {
        return $this->hasMany(RegistryItemUrl::class, 'registry_item_id', 'id');
    }

    public function party()
    {
        return $this->hasOne(Party::class, 'id', 'party_id');
    }
}
