<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class Color extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Color>
     */
    public static $model = \App\Models\Color::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'color';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'color'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            \Laravel\Nova\Fields\Color::make('Color')
                ->sortable()
                ->showOnPreview()
                ->rules('required', 'string', 'max:255')
                ->creationRules('unique:colors,color')
                ->updateRules('unique:colors,color,{{resourceId}}'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
