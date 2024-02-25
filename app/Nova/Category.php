<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Category>
     */
    public static $model = \App\Models\Category::class;

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

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        $url = Str::after($request->headers->get('referer'), 'resources/');

        if ($url === 'products/new') {
            // TODO:: get categories from user
            return $query->whereNotNull('parent_id');
        }

        $pattern = "/products\/(\d+)\/edit/";
        preg_match($pattern, $url, $matches);

        if (!empty($matches)) {
            $productId = $matches[1];
            $product = \App\Models\Product::with('store.categories')->find($productId);
            $categories = $product->store->categories->pluck('id')->toArray();
            return $query->whereIn('parent_id', $categories);
        }

        if ($url === 'categories') {
            return $query->whereNull('parent_id');
        }

        if (Str::contains($url, 'categories')) {
            return $query;
        }

        return $query->whereNull('parent_id');
    }

    public static function defaultOrderings($query): Relation|Builder
    {
        return $query->orderBy('order');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Image::make('English Image', 'image_en')
                ->disk('public')
                ->path('categories')
                ->creationRules('required', 'image')
                ->updateRules('image')
                ->detailWidth(400),

            Image::make('Arabic Image', 'image_ar')
                ->disk('public')
                ->path('categories')
                ->creationRules('required', 'image')
                ->updateRules('image')
                ->detailWidth(400),

            Text::make('English Name', 'name_en')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Arabic Name', 'name_ar')
                ->sortable()
                ->rules('required', 'max:255'),

            Number::make('Order')
                ->sortable()
                ->rules('required', 'integer', 'min:0'),

            Boolean::make('Is Active')
                ->sortable(),

            BelongsTo::make('Parent', 'parent', self::class)
                ->searchable()
                ->relatableQueryUsing(fn(NovaRequest $request, $query) => $query->where('id', '!=', $request->resourceId))
                ->nullable(),

            HasMany::make('Children', 'children', self::class),
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
        return [
        ];
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
