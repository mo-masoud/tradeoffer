<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function saved(Comment $comment): void
    {
        $comment->commentable->update([
            'rating' => $this->calculateAverageRating($comment)
        ]);

        if ($comment->commentable_type === 'App\Models\Product') {
            $comment->commentable->store->update([
                'rating' => $this->calculateAverageRating($comment)
            ]);

            $comment->commentable->branches->each->update([
                'rating' => $this->calculateAverageRating($comment)
            ]);
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
            $comment->commentable->store->update([
                'rating' => $this->calculateAverageRating($comment)
            ]);

            $comment->commentable->branches->each->update([
                'rating' => $this->calculateAverageRating($comment)
            ]);
        }
    }
}
