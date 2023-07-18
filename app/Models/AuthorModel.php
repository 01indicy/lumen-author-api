<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class AuthorModel extends Model {
    protected $table = "authors";
    protected $fillable = ["name","email","gender"];

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(BookModel::class);
    }
}
