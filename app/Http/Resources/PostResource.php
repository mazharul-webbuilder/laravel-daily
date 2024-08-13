<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Check Resource_Paginate.md file
        // Check ResourceController to know how to paginate a resource
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            // Include any additional fields or relationships as needed
        ];
    }
}
