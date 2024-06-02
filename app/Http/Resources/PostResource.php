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
        return [
            'postId' => $this->id,
            'userId' => $this->user_id,
            'body' => $this->body,
            'post_image' => 'uploads/' . @$this->image->name,
            'likesCount' => count($this->likes),
            'commentsCount' => count($this->comments)
        ];
    }
}
