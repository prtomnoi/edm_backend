<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InfluencerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($influencer) {
            return [
                'id' => $influencer->id,
                'name' => $influencer->name,
                'title' => $influencer->title,
                'subscribe' => $influencer->subscribe,
                'facebook' => $influencer->facebook,
                'twitter' => $influencer->twitter,
                'youtube' => $influencer->youtube,
                'instagram' => $influencer->instagram,
                'icon' => asset($influencer->icon),
                'image' => asset( $influencer->image),
                'status' => $influencer->status,
                'created_by' => $influencer->createdBy->name ?? 'Unknown',
                'updated_by' => $influencer->updatedBy->name ?? 'Unknown',
            ];
        });
    }
}
