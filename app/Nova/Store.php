<?php

namespace App\Nova;

use App\Enums\RoleEnum;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->can('stores.create')) {
            return $query;
        }

        return $query->where('user_id', $request->user()->id);
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

            Image::make('Image')
                ->deletable(false)
                ->disk('public')
                ->path('stores')
                ->creationRules('required')
                ->updateRules('image'),

            Text::make('Name En')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Name Ar')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Description En')
                ->nullable()
                ->sortable()
                ->rules('max:255'),

            Text::make('Description Ar')
                ->nullable()
                ->sortable()
                ->rules('max:255'),

            BelongsTo::make('User')
                ->showCreateRelationButton()
                ->searchable()
                ->relatableQueryUsing(fn($request, $query) => $query->whereRole(RoleEnum::StoreManager->value)->whereDoesntHave('store'))
                ->rules('required')
                ->canSeeWhen('stores.create'),

            Boolean::make('Is Active')
                ->sortable()
                ->rules('required')
                ->canSeeWhen('stores.delete'),
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
