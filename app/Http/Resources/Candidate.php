<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Candidate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
           "meta"=> [
               "success"=> true,
               "message"=> []
           ],
           "data"=> [   
               "id"=> $this->id,
               "name"=>$this->name,
               "source"=>$this->source,
               "owner"=>$this->owner,
               "created_at"=>$this->created_at,
                "created_by"=>$this->created_by,
           ]
        ];	
    }
}
