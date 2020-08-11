<?php


namespace App\Services\Party\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rsvp extends Model
{
    use  SoftDeletes;

    protected $table = 'rsvps';

    protected $fillable = [
        'party_id',
        'count',
        'attending',
        'ceremony',
        'reception',
        'response_may_change',
    ];

    protected $casts = [
        'id' => "integer",
        'count' => 'integer',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];
}
