<?php

namespace App\Http\Resources\V1;

use App\Http\Controllers\Api\V1\GenreController;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V1\GenreResource;

class MovieResource extends JsonResource
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
            'title' => $this->title,
            'releaseDate' => $this->release_date,
            'genre' => (new GenreResource($this->whenLoaded('genre')))->title,
        ];
    }
}
