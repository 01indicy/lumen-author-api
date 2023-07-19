<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model {
    protected $table = 'books';
    protected $fillable = ['book_name','price','author_id'];
    public function authors(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(AuthorModel::class,'id');
    }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(CommentModel::class,'comment_id');
    }
}