<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $commentable_type
 * @property mixed $commentable_id
 */
class StoreCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string|in:product',
            'comment' => 'required|string',
            'rating' => 'required|numeric|between:0,5',
        ];
    }

    public function placeComment()
    {
        $commentableModel = $this->commentableModel();

        $comment = $commentableModel->comments->where('user_id', auth()->id())->first();

        if ($comment) {
            $comment->update($this->validated());
            return $comment->refresh();
        } else {
            return $commentableModel->comments()->create(array_merge($this->validated(), ['user_id' => auth()->id()]));
        }
    }

    protected function commentableModel(): Model
    {
        $this->commentable_type;
        $model = Product::class;

        return $model::with('comments')->findOrFail($this->commentable_id);
    }
}
