<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NovelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
        ];
    }
}
