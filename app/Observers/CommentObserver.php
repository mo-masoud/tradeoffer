<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Store;

class CommentObserver
{
    public function saved(Comment $comment): void
    {
        $comment->commentable->update([
            'rating' => $this->calculateAverageRating($comment)
        ]);

        if ($comment->commentable_type === 'App\Models\Product') {
            $avgRating = Product::where('store_id', $comment->commentable->store_id)->where('rating', '>', 0)->avg('rating');

            Store::where('id', $comment->commentable->store_id)->update([
                'rating' => $avgRating
            ]);

            $branches = $comment->commentable->branches()->with('products')->get();

            foreach ($branches as $branch) {
                $avgRating = $branch->products()->where('rating', '>', 0)->avg('rating');
                $branch->update([
                    'rating' => $avgRating
                ]);
            }
        }
    }

    public function calculateAverageRating(Comment $comment)
    {
        $model = $comment->commentable;
        return $model->comments()->avg('rating') ?? 0;
    }

    /**
     * Handle the Comment "deleting" event.
     */
    public function deleting(Comment $comment): void
    {
        $comment->commentable->update([
            'rating' => $this->calculateAverageRating($comment)
        ]);

        if ($comment->commentable_type === 'App\Models\Product') {
            $avgRating = Product::where('store_id', $comment->commentable->store_id)->where('rating', '>', 0)->avg('rating');

            Store::where('id', $comment->commentable->store_id)->update([
                'rating' => $avgRating
            ]);

            $branches = $comment->commentable->branches()->with('products')->get();

            foreach ($branches as $branch) {
                $avgRating = $branch->products()->where('rating', '>', 0)->avg('rating');
                $branch->update([
                    'rating' => $avgRating
                ]);
            }
        }
    }
}
