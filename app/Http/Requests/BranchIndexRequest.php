<?php

namespace App\Http\Requests;

use App\Models\Branch;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;

class BranchIndexRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'store' => 'nullable|integer|exists:stores,id',
            'search' => 'nullable|string',
            'category' => 'nullable|integer|exists:categories,id',
            'order_by_rate' => 'nullable|boolean',
            'order_by_nearest' => 'nullable|string',
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer'
        ];
    }

    public function buildQuery(): Builder
    {
        return Branch::with([
            'store'
        ])
            ->when($this->has('store'), function ($query) {
                $query->where('store_id', $this->input('store'));
            })
            ->when($this->has('search'), function ($query) {
                $query->where(function ($query) {
                    $query->where('name_en', 'like', '%' . $this->input('search') . '%')
                        ->orWhere('name_ar', 'like', '%' . $this->input('search') . '%')
                        ->orWhere('address_en', 'like', '%' . $this->input('search') . '%')
                        ->orWhere('address_ar', 'like', '%' . $this->input('search') . '%')
                        ->orWhere('phone', 'like', '%' . $this->input('search') . '%')
                        ->orWhereHas('store', function ($query) {
                            $query->where('name_en', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('description_en', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('description_ar', 'like', '%' . $this->input('search') . '%');
                        })
                        ->orWhereHas('products', function ($query) {
                            $query->where('name_en', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('description_en', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('description_ar', 'like', '%' . $this->input('search') . '%');
                        })
                        ->orWhereHas('products.categories', function ($query) {
                            $query->where('name_en', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $this->input('search') . '%');
                        })
                        ->orWhereHas('store.categories', function ($query) {
                            $query->where('name_en', 'like', '%' . $this->input('search') . '%')
                                ->orWhere('name_ar', 'like', '%' . $this->input('search') . '%');
                        });
                });
            })
            ->when($this->has('category'), function ($query) {
                $query->whereHas('products.categories', function ($query) {
                    $query->where('id', $this->input('category'));
                })->orWhereHas('store.categories', function ($query) {
                    $query->where('id', $this->input('category'));
                });
            })
            ->when($this->has('order_by_nearest'), function ($query) {
                $query->orderByDistanceWithinCoveredZone($this->input('order_by_nearest'));
            })
            ->when($this->has('order_by_rate'), function ($query) {
                $query->orderBy('rating', 'desc');
            })
            ->latest();
    }
}
