<?php

namespace App\Nova;

use Ardenthq\ImageGalleryField\ImageGalleryField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Offer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Offer>
     */
    public static $model = \App\Models\Offer::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'description',
    ];

    public static function relatableProducts(NovaRequest $request, $query)
    {
        if ($request->resourceId) {
            $offer = \App\Models\Offer::findOrFail($request->resourceId);
            return $query->where('branch_id', $offer->branch_id);
        }

        return $query;
    }

    public static function relatableBranches(NovaRequest $request, $query)
    {
        if ($request->resourceId) {
            $offer = \App\Models\Offer::findOrFail($request->resourceId);
            return $query->where('store_id', $offer->store_id);
        }

        return $query;
    }

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

            BelongsTo::make('Store')
                ->sortable()
                ->searchable(),

            Text::make('Title (English)', 'title_en')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Title (Arabic)', 'title_ar')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description (English)', 'description_en')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Description (Arabic)', 'description_ar')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            ImageGalleryField::make('Images')
                ->rules('image')
                ->showOnIndex(),

            Number::make('Discount')
                ->sortable()
                ->placeholder('Discount percentage % for each products in offer')
                ->rules('max:100'),

            Number::make('Max Discount')
                ->sortable()
                ->placeholder('Apply max discount for each products in offer')
                ->rules('nullable', 'min:1')
                ->hideFromIndex(),

            DateTime::make('Start At')
                ->sortable()
                ->default(now())
                ->rules('required', 'after_or_equal:today'),

            DateTime::make('End At')
                ->sortable()
                ->rules('required', 'after:start_at'),

            Boolean::make('Featured')
                ->sortable(),

            BelongsToMany::make('Products'),


            BelongsToMany::make('Branches'),
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
