<?php

namespace App\Nova;

use App\Enums\RoleEnum;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Mostafaznv\NovaMapField\Fields\MapPointField;

class Branch extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Branch>
     */
    public static $model = \App\Models\Branch::class;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name_en', 'name_ar', 'address_en', 'address_ar',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->can('branches.create')) {
            return $query;
        }

        if ($request->user()->hasRole(RoleEnum::StoreManager->value)) {
            return $query->whereHas('store', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });
        }

        return $query->where('user_id', $request->user()->id);
    }

    public function title()
    {
        return $this->name_en . ' - ' . $this->store->name_en;
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

            BelongsTo::make('Store', 'store', Store::class)
                ->sortable()
                ->showCreateRelationButton()
                ->searchable()
                ->canSee(function ($request) {
                    return $request->user()->can('branches.create');
                })
                ->rules('required'),

            BelongsTo::make('Branch Manager', 'user', User::class)
                ->sortable()
                ->showCreateRelationButton()
                ->searchable()
                ->nullable()
                ->canSee(function ($request) {
                    return $request->user()->can('branches.create');
                })
                ->relatableQueryUsing(fn($request, $query) => $query->whereRole(RoleEnum::BranchManager->value)),

            Text::make('Name (English)', 'name_en')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Name (Arabic)', 'name_ar')
                ->sortable()
                ->rules('required', 'max:255'),

            Boolean::make('Is Active', 'is_active')
                ->sortable()
                ->rules('required')
                ->canSeeWhen('branches.create'),

            Number::make('Rating')->sortable()->hideWhenCreating()->hideWhenUpdating(),

            Text::make('Phone')
                ->sortable()
                ->rules('nullable', 'max:255'),

            Panel::make('Address', $this->addressFields())->collapsable(),

            BelongsToMany::make('Products')->fields(function () {
                return [
                    Boolean::make('In Stock', 'in_stock')
                        ->sortable()
                        ->rules('required'),
                ];
            }),
        ];
    }

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function addressFields()
    {
        return [
            Text::make('Address (English)', 'address_en')
                ->sortable()
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Address (Arabic)', 'address_ar')
                ->sortable()
                ->rules('required', 'max:255'),

            MapPointField::make('Location')
                ->hideFromIndex()
                ->rules('required'),

            Number::make('Covered Zone', 'covered_zone')
                ->sortable()
                ->hideFromIndex()
                ->rules('required', 'integer', 'min:1', 'max:100')
                ->default(7)
                ->canSeeWhen('branches.create'),
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
