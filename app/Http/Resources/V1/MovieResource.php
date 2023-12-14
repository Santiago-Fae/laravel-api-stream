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
        $resourceArray = [
            'id' => $this->id,
            'title' => $this->title,
            'releaseDate' => $this->release_date
        ];

        if ($this->resource->mediaRating) {
            $resourceArray['mediaRating'] = $this->mediaRating;
        }
        if ($this->resource->genre) {
            $resourceArray['genre'] = (new GenreResource($this->whenLoaded('genre')))->title;
        }

        return $resourceArray;
    }
}
