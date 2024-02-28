<?php

namespace App\Nova;

use Ardenthq\ImageGalleryField\ImageGalleryField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Tag;
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
    public static $title = 'name_en';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name_en', 'name_ar',
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

            BelongsTo::make('Store', 'store', Store::class)
                ->sortable()
                ->searchable(),

            ImageGalleryField::make('Images')
                ->rules('image')
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

            KeyValue::make('Meta')
                ->keyLabel('Specification')
                ->valueLabel('Value')
                ->help(view('fields-help.product-meta')->render())
                ->rules('json'),

            Number::make('Price', 'price')
                ->sortable()
                ->min(1)
                ->step(0.01)
                ->rules('required'),

            Number::make('Discount')
                ->sortable()
                ->min(1)
                ->step(0.01)
                ->max(100),

            Number::make('Rating')->sortable()->hideWhenCreating()->hideWhenUpdating(),

            Tag::make('Categories')
                ->withPreview()
                ->preload()
                ->displayAsList(),

            Tag::make('Colors')
                ->withPreview()
                ->preload()
                ->showCreateRelationButton(),

            Tag::make('Sizes')
                ->withPreview()
                ->preload()
                ->showCreateRelationButton(),

            BelongsToMany::make('Colors')
                ->showCreateRelationButton()
                ->fields(function () {
                    return [
                        Number::make('Extra Price', 'extra_price')
                            ->min(0)
                            ->step(0.01)
                            ->default(0)
                            ->rules('required'),
                        Boolean::make('In Stock', 'in_stock')
                            ->default(true)
                            ->rules('required'),
                    ];
                }),

            BelongsToMany::make('Sizes')
                ->showCreateRelationButton()
                ->fields(function () {
                    return [
                        Number::make('Extra Price', 'extra_price')
                            ->min(0)
                            ->step(0.01)
                            ->default(0)
                            ->rules('required'),
                        Boolean::make('In Stock', 'in_stock')
                            ->default(true)
                            ->rules('required'),
                    ];
                }),

            BelongsToMany::make('Attributes', 'attributes', AttributeValue::class)
                ->showCreateRelationButton()
                ->fields(function () {
                    return [
                        Number::make('Extra Price', 'extra_price')
                            ->min(0)
                            ->step(0.01)
                            ->default(0)
                            ->rules('required'),
                        Boolean::make('In Stock', 'in_stock')
                            ->default(true)
                            ->rules('required'),
                    ];
                }),

            HasMany::make('Addons', 'addons', ProductAddon::class),

            MorphMany::make('Comments'),
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
