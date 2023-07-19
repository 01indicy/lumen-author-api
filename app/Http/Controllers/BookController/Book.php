<?php

namespace App\Http\Controllers\BookController;

use App\Models\AuthorModel;
use App\Models\BookModel;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;


class Book extends \App\Http\Controllers\Controller{
    function getBooks(): \Illuminate\Http\JsonResponse {
        $books = BookModel::with('Authors')->get();
        return response()->json(['data'=>$books,'totalCount'=>$books->count()]);
    }

    function getBookByID($id): \Illuminate\Http\JsonResponse {
        $book = BookModel::with('Authors')->find($id);
        if(!$book) return response()->json(['message'=>'Book not found'],404);
        return response()->json(['data'=>$book]);
    }

    function storeBook(Request $request): \Illuminate\Http\JsonResponse {
        try {
            $this->validate($request,["book_name"=>"required","price"=>"required","author_id"=>"required"]);
            $newBookDetails = $request->only(['book_name','price','author_id']);

            $checkAuthorIfExists = AuthorModel::find($newBookDetails['author_id']);
            if(!$checkAuthorIfExists) return response()->json(["error"=>"Author not found"],404);

            if(!is_numeric($newBookDetails['price']) && !is_float($newBookDetails['price'])) return response()->json(['error'=>'Price is not valid'],409);

            $resData = BookModel::create($newBookDetails);
            return response()->json($resData,201);
        }catch (ValidationException $e){
            $errors = $e->getMessage();
            return response()->json(["error"=>$errors],500);
        }
    }

    function updateBook(Request $request,$id): \Illuminate\Http\JsonResponse {
        try {
            $this->validate($request, ["book_name" => "required", "price" => "required", "author_id" => "required", "id" => "required"]);
            $bookDetails = $request->only(['book_name','price','author_id','id']);

            $bookDetail = BookModel::find($id);
            if(!$bookDetail) return response()->json(["error"=>"Book not found"],404);
            if(!is_numeric($bookDetails['price']) && !is_float($bookDetails['price'])) return response()->json(['error'=>'Price is not valid'],409);

            $bookDetail->fill($bookDetails);
            $bookDetail->save();
            return response()->json($bookDetail);
        } catch (ValidationException $e) {
            $errors = $e->getMessage();
            return response()->json(["error"=>$errors],500);
        }
    }
}