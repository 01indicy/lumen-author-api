<?php

namespace App\Http\Controllers\BookController;

use App\Models\BookModel;

class Book extends \App\Http\Controllers\Controller{
    function getBooks(): string {
        $books = BookModel::with('Authors')->get();
        return response()->json($books);
    }
}