<?php

namespace App\Modules\Elasticsearch;

use App\Modules\NewsProviders\Resources\NewsResource;
use Illuminate\Support\Facades\Http;

class ElasticsearchClient
{
    protected string $baseUrl;
    protected string $index;

    public function __construct()
    {
        $elasticsearchConfig = config('services.elasticsearch');
        $this->baseUrl = "{$elasticsearchConfig['host']}:{$elasticsearchConfig['port']}";
        $this->index = $elasticsearchConfig['index'];
    }

    public function indexDocument(NewsResource $document)
    {
        $url = "{$this->baseUrl}/$this->index/_doc";

        $response = Http::post($url, $document->toArray());

        return $response->json();
    }

    public function searchDocuments($query)
    {
        $url = "{$this->baseUrl}/$this->index/_search";
        $response = Http::post($url, $query);

        return $response->json();
    }
}
