<?php
namespace App\DTO;

use Illuminate\Support\Collection;

class JobDTO
{
    private Collection $urls;
    private Collection $selectors;

    public function __construct(Collection $urls, Collection $selectors)
    {
        $this->urls = $urls;
        $this->selectors = $selectors;
    }

    public function getUrls(): Collection
    {
        return $this->urls;
    }

    public function getSelectors(): Collection
    {
        return $this->selectors;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            collect($data['urls'] ?? []),
            collect($data['selectors'] ?? [])
        );
    }
}