<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($campaign) {
            return [
                'id' => $campaign->id,
                'title' => $campaign->title,
                'short_detail' => $campaign->short_detail,
                'detail' => $campaign->detail,
                'reward1' => $campaign->reward1,
                'reward2' => $campaign->reward2,
                'reward3' => $campaign->reward3,
                'reward4' => $campaign->reward4,
                'image' => asset($campaign->image),
                'status' => $campaign->status,
                'created_by' => $campaign->createdBy->name ?? 'Unknown',
                'updated_by' => $campaign->updatedBy->name ?? 'Unknown',
            ];
        });
    }
}
