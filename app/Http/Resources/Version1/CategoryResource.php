<?php

namespace App\Http\Resources\Version1;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'is_enabled' => $this->is_enabled,
            'created_by' => $this->createdBy->fullname,
            'modified_by' => $this->modifiedBy->fullname,
            'uid' => $this->uid,
            'image_url' => $this->image_url,
            'image_name' => $this->image_name,
            'created_at' => $this->created_at,
            'created_at_formatted' => $this->created_at->format('j F, Y'),
            'updated_at' => $this->updated_at,
            'updated_at_formatted' => $this->created_at->format('j F, Y'),
        ];
    }

    public function with($request) 
    {
        return [
            'status' => 'success',
            'code' => request()->method() == 'GET' ? 200 : 201,
            'title' => request()->method() == 'GET' ? 'OK' : 'Created',
            'message' => request()->method() == 'GET' ? 'Done successfully' : 'Created successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
        ];
    }
}
