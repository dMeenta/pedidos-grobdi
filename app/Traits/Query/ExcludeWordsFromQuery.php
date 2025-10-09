<?php

namespace App\Traits\Query;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait ExcludeWordsFromQuery
{
    /**
     * @param EloquentBuilder|QueryBuilder $query - Accepts Eloquent && Query Builders
     * for example: Pedidos::query() or DB:table('pedidos')
     * @param string $columnName
     * @param array  $wordsToExclude - Every word must specified '%' character
     * for example: '%delivery%', 'bolsas%'
     * @return EloquentBuilder|QueryBuilder return the modified query
     */
    protected function excludeArrayFromDataResults(EloquentBuilder|QueryBuilder $query, string $columnName, array $wordsToExclude): EloquentBuilder|QueryBuilder
    {
        foreach ($wordsToExclude as $word) {
            $query->whereRaw("LOWER({$columnName}) NOT LIKE ?", [strtolower($word)]);
        }

        return $query;
    }
}