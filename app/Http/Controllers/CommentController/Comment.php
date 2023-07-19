<?php

namespace App\Http\Controllers\CommentController;

use App\Models\BookModel;
use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Comment extends \App\Http\Controllers\Controller{
    function getComment(): \Illuminate\Http\JsonResponse {
        $comments = CommentModel::with('Books.Authors')->get();
        return response()->json($comments);
    }
    function storeComment(Request $request): \Illuminate\Http\JsonResponse {
        try {
            $this->validate($request, ["book_id" => "required", "description" => "required"]);
            $data = $request->only(["book_id","description"]);

            $checkBookExistence = BookModel::find($data['book_id']);
            if(!$checkBookExistence) return response()->json(["error"=>"Book not found"],404);

            $resData = CommentModel::create($data);
            return response()->json($resData,201);
        } catch (ValidationException $e) {
            $errors = $e->getMessage();
            return response()->json(["error"=>$errors],500);
        }
    }
}