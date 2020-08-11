<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PartyResource extends Resource
{
    public function toArray($request)
    {
        $entry = parent::toArray($request);
        return $entry;
    }
}
