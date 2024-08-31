<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'id' =>$this->id,
            'name' =>$this->title,
            'description'=>$this->description,
            'date'=>$this->created_at,
            // 'category' =>$this->category->name,// using relation => Project->category->name
            'category' => new CategoryResource($this->category), // with custom api resource
            'tags' => TagsResource::collection($this->tags),  
            '_links'=>[
                '_self'=> url('api/projects' , $this->id),
            ],  
        ];
    }
}
