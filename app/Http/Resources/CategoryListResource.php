<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status == 1 ? 'Active' : 'Inactive',
            'order_by' => $this->order_by,
            'created_at' => $this->created_at->toDayDateTimeString(),
            'updated_at' => $this->updated_at != $this->created_at ? $this->updated_at->toDayDateTimeString() : "Not updated"

        ];
    }
}
