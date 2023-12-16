<?php

namespace App\Modules\Elasticsearch\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $document = $this->resource['_source'];

        return [
            'published_at' => $document['published_at'],
            'category' => $document['category'],
            'source' => $document['source'],
            'title' => $document['title'],
            'content' => $document['content'],
            'cover_url' => $document['cover_url'],
            'primary_link' => $document['primary_link'],
            'author' => $document['author'],
        ];
    }
}
