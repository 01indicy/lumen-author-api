<?php

namespace App\Models;

class CommentModel extends \Illuminate\Database\Eloquent\Model {
    protected $table = "comments";
    protected $fillable = ["book_id","description"];
    function books(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(BookModel::class,'book_id');
    }
}