<?php

namespace App\Modules\NewsProviders\Resources;

class NewsResource
{
    public function __construct(
        private readonly string $title, private readonly string $content, private readonly string $category,
        private readonly string $source, private readonly string $primaryLink, private readonly string $publishedAt,
        private readonly ?string $description = null, private readonly ?string $author = null, private readonly ?string $coverUrl = null
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getSource(): string
    {
        return $this->source;
    }
    public function getPrimaryLink(): string
    {
        return $this->primaryLink;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getCoverUrl(): ?string
    {
        return $this->coverUrl;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'content' => $this->getContent(),
            'category' => $this->getCategory(),
            'source' => $this->getSource(),
            'author' => $this->getAuthor(),
            'primary_link' => $this->getPrimaryLink(),
            'cover_url' => $this->getCoverUrl(),
            'published_at' => $this->getPublishedAt(),
        ];
    }
}
