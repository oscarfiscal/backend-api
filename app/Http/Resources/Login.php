<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Login extends JsonResource
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
          "meta" => [
            "success" => "true",
            "error" => "false",
          ],
            "data" => [
                "id_user" => auth()->user()->id,
                "token" => $this->resource,
                "minutes_to_expire" => 1440, // 24 hours
              
            ],
        ];
    }
}
