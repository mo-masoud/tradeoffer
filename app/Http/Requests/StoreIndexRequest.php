<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreIndexRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'nullable|integer|exists:categories,id',
            'featured' => 'nullable|boolean',
            'order_by_rate' => 'nullable|boolean',
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer'
        ];
    }

    public function buildQuery()
    {
        return Store::when(
            $this->input('category'),
            fn($query) => $query->filterByCategory($this->input('category'))
        )
            ->when($this->input('featured') == 1, fn($query) => $query->featured())
            ->when($this->input('order_by_rate') == 1, fn($query) => $query->orderBy('rating', 'desc'))
            ->active()
            ->latest();
    }
}
