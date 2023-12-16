<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email
        ];

        if ($this->token) {
            $result['token'] = $this->token;
        }

        return $result;
    }
}
