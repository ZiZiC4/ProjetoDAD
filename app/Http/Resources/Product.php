<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
             'name'=> $this->name,
             'type'=> $this->type,
             'description'=> $this->description,
             'photo_url'=> $this->photo_url,
             'price'=> $this->price
             //'date_create'=> $this->created_at->toDateTimeString(),
             //'date_update'=> $this->updated_at->toDateTimeString(),
             //'date_delete'=> $this->deleted_at->toDateTimeString()
        ];
    }
}
