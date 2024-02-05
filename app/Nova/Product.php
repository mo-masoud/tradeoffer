<?php

namespace App\Nova;

use Ardenthq\ImageGalleryField\ImageGalleryField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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

            BelongsTo::make('Category', 'category', Category::class)
                ->sortable()
                ->searchable(),

            BelongsTo::make('Branch', 'branch', Branch::class)
                ->sortable()
                ->searchable(),

            ImageGalleryField::make('Images')
                ->rules('mimes:jpeg,png,jpg,gif')
                ->showOnIndex(),

            Text::make('Name (English)', 'name_en')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Name (Arabic)', 'name_ar')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description (English)', 'description_en')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Description (Arabic)', 'description_ar')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Number::make('Price', 'price')
                ->sortable()
                ->min(1)
                ->rules('required'),

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
