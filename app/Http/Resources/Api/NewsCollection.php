<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($news) {
            return [
                'id' => $news->id,
                'title' => $news->title,
                'detail' => $news->detail,
                'image' => asset($news->image), // Full URL to the image
                'status' => $news->status,
                'provider_id' => $news->provider_id,
                'created_by' => $news->createdBy->name ?? 'Unknown', 
                'updated_by' => $news->updatedBy->name ?? 'Unknown', 
            ];
        });
    }
}
