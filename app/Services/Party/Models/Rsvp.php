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
        'rehearsal'
    ];

    protected $casts = [
        'id' => "integer",
        'count' => 'integer',
        'attending' => 'integer',
        'ceremony' => 'integer',
        'reception' => 'integer',
        'response_may_change' => 'integer',
        'rehearsal' => 'integer',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];
}
