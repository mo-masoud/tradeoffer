<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $order_by_price
 * @property mixed $max_price
 * @property mixed $min_price
 * @property mixed $search
 * @property mixed $branch
 * @property mixed $store
 * @property mixed $category
 * @property mixed $top_selling
 * @property mixed $order_by_rate
 */
class ProductIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'top_selling' => 'nullable|boolean',
            'category' => 'nullable|exists:categories,id',
            'store' => 'nullable|exists:stores,id',
            'branch' => 'nullable|exists:branches,id',
            'search' => 'nullable|string',
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric',
            'order_by_price' => 'nullable|in:asc,desc',
            'order_by_rate' => 'nullable|boolean',
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

    public function buildQuery(): Builder
    {
        return Product::with('media', 'categories', 'colors', 'sizes', 'store', 'attributes', 'attributes.attribute', 'addons')
            ->when(
                $this->top_selling,
                fn($query) => $query->topSelling()
            )
            ->when(
                $this->category,
                fn($query) => $query->filterByCategory($this->category)
            )
            ->when(
                $this->store,
                fn($query) => $query->where('store_id', $this->store)
            )
            ->when(
                $this->branch,
                fn($query) => $query->whereHas('branches', fn($query) => $query->where('id', $this->branch))
            )
            ->when(
                $this->search,
                fn($query) => $query->search($this->search)
            )
            ->when(
                $this->min_price && $this->max_price,
                fn($query) => $query->filterByPrice($this->min_price, $this->max_price)
            )
            ->when(
                $this->order_by_price,
                fn($query) => $query->orderByPrice($this->order_by_price)
            )
            ->when(
                $this->order_by_rate,
                fn($query) => $query->orderBy('rating', 'desc')
            )
            ->latest();
    }
}
