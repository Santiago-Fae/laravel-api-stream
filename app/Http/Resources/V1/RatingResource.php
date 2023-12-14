<?php

namespace App\Http\Resources\V1;

use App\Http\Controllers\Api\V1\GenreController;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V1\UserResource;
use App\Http\Resources\V1\MovieResource;

class RatingResource extends JsonResource
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
            'id' => $this->id,
            'rating' => $this->rating,
            'movie' => new MovieResource($this->whenLoaded('movie')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
