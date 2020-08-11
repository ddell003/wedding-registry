<?php


namespace App\Services\Party\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use  SoftDeletes;

    protected $table = 'party';

    protected $fillable = [
        'name',
        'email',
        'slug',
        'rehearsal',
        'street',
        'street2',
        'city',
        'state',
        'zip',
        'country'
    ];

    protected $casts = [
        'id' => "integer",
        'slug' => 'string',
        'rehearsal' => 'integer',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];


    public function users()
    {
        return $this->hasMany(User::class, 'party_id', 'id');
    }

    public function rsvp()
    {
        return $this->hasOne(Rsvp::class, 'party_id', 'id');
    }

   /*
   $table->string('email');
            $table->string('street');
            $table->string('street2');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
   public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function templates()
    {
        return $this->belongsToMany(Template::class, 'assets_templates', 'asset_id', 'template_id');
    }*/

}
