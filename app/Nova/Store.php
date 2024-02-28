<?php

namespace App\Nova;

use App\Enums\RoleEnum;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Store extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Store>
     */
    public static $model = \App\Models\Store::class;
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
        'id', 'name_en', 'name_ar', 'description_en', 'description_ar',
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

            Image::make('Image')
                ->deletable(false)
                ->disk('public')
                ->path('stores')
                ->creationRules('required')
                ->updateRules('image')
                ->indexWidth(100)
                ->detailWidth(400),

            Image::make('Cover Image')
                ->deletable(false)
                ->disk('public')
                ->path('stores')
                ->creationRules('required')
                ->updateRules('image')
                ->indexWidth(100)
                ->detailWidth(400),

            Text::make('Name (English)', 'name_en')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Name (Arabic)', 'name_ar')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description (English)', 'description_en')
                ->nullable()
                ->hideFromIndex()
                ->rules('max:255'),

            Text::make('Description (Arabic)', 'description_ar')
                ->nullable()
                ->hideFromIndex()
                ->rules('max:255'),

            Tag::make('Categories')
                ->withPreview()
                ->preload()
                ->displayAsList(),

            Number::make('Rating')->sortable()->hideWhenCreating()->hideWhenUpdating(),

            BelongsTo::make('Store Manager', 'user', User::class)
                ->showCreateRelationButton()
                ->searchable()
                ->relatableQueryUsing(fn($request, $query) => $query->whereRole(RoleEnum::StoreManager->value))
                ->rules('required')
                ->peekable()
                ->canSeeWhen('stores.create'),

            HasMany::make('Branches', 'branches', Branch::class)
                ->canSeeWhen('branches.viewAny'),

            Boolean::make('Is Active')
                ->sortable()
                ->rules('required')
                ->canSeeWhen('stores.delete'),

            HasMany::make('Products', 'products', Product::class),
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
