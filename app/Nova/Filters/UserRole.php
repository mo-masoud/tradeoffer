<?php

namespace App\Nova\Filters;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserRole extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

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
        return $query->whereRole($value);
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
            'Super Admin' => RoleEnum::SuperAdmin,
            'Admin' => RoleEnum::Admin,
            'Store Manager' => RoleEnum::StoreManager,
            'User' => RoleEnum::User,
        ];
    }
}
