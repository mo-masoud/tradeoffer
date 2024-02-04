<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class ParentCategory extends Filter
{
    public $component = 'select-filter';

    public function default()
    {
        return 'all';
    }

    /**
     * Apply the filter to the given query.
     *
     * @param NovaRequest $request
     * @param Builder $query
     * @param mixed $value
     * @return Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        if ($value === 'main') {
            return $query->whereNull('parent_id');
        }
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return [
            'Main' => 'main',
            'All' => 'all',
        ];
    }
}
