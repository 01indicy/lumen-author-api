<?php

namespace App\Http\Controllers\AuthorController;

use App\Models\AuthorModel;
use Illuminate\Http\Request;

class Author extends \App\Http\Controllers\Controller {
    function getAuthors (): \Illuminate\Http\JsonResponse {
        $authors = AuthorModel::all();
        return response()->json($authors);
    }

    function storeAuthor(Request $request): \Illuminate\Http\JsonResponse {
        $data = $request->only(['name', 'email', 'gender']);

        $checkEmail = AuthorModel::where('email', $data['email'])->get();
        if(sizeof($checkEmail) > 0) return response()->json(['message'=>'email is already registered'],'409');
        $create = AuthorModel::create($data);
        return response()->json($create,201);
    }

    function getSingleAuthorDetails($id): \Illuminate\Http\JsonResponse {
        $authorInfo = AuthorModel::find($id);
        if (!$authorInfo) return response()->json(['message'=>'user not found'],404);
        return response()->json($authorInfo);
    }

    function updateAuthorDetails(Request $request,$id): \Illuminate\Http\JsonResponse {
        $authorInfo = AuthorModel::find($id);
        if (!$authorInfo) return response()->json(['message'=>'user not found'],404);

        $data = $request->only(['name', 'email', 'gender']);
        $authorInfo->fill($data);
        $authorInfo->save();
        return response()->json($authorInfo);
    }

    function destroyAuthor($id): \Illuminate\Http\JsonResponse {
        $authorInfo = AuthorModel::find($id);
        if (!$authorInfo) return response()->json(['error' => 'AuthorController not found'], 404);

        $authorInfo->delete();
        return response()->json(['message' => 'AuthorController deleted']);
    }
}