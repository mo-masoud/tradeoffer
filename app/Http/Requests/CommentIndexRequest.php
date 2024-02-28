<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentIndexRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'commentable_type' => 'required|string|in:product',
            'commentable_id' => 'required|integer',
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

    public function buildQuery()
    {
        $this->get('commentable_type');
        $model = Product::class;

        $modelData = $model::findOrFail($this->get('commentable_id'));
        return $modelData->comments()->orderBy('created_at', 'desc');
    }
}
