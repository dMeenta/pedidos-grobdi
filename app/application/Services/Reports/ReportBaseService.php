<?php

namespace App\Application\Services\Reports;

use Illuminate\Support\Facades\Cache;

/**
 * Parent class for Reports
 */
abstract class ReportBaseService
{
    protected string $cachePrefix = 'report_';
    protected int $cacheTtl = 3600;

    /**
     *  Get an unique filter based key
     */
    protected function generateCacheKey(array $filters): string
    {
        return $this->cachePrefix . md5(serialize($filters));
    }

    /**
     * Get data from cache if exists
     */
    protected function getFromCache(string $key): mixed
    {
        return Cache::get($key);
    }

    /**
     * Save data in cache
     */
    protected function saveToCache(string $key, mixed $data): void
    {
        Cache::put($key, $data, $this->cacheTtl);
    }

    /**
     * Template method for automatic data obtain from cache
     */
    public function getData(array $filters = []): mixed
    {
        $cacheKey = $this->generateCacheKey($filters);

        if ($cached = $this->getFromCache($cacheKey)) {
            return $cached;
        }

        $data = $this->createInitialReport();

        if (!empty($filters)) {
            $data = $this->applyFilters($data, $filters);
        }

        $this->saveToCache($cacheKey, $data);

        return $data;
    }

    /**
     * Create specified DTO (must implement - overwrite)
     */
    abstract protected function createInitialReport(): mixed;

    /**
     * Apply filters for the report requested
     */
    protected function applyFilters(mixed $data, array $filters): mixed
    {
        return $data;
    }
}
