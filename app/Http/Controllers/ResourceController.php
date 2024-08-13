<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Exception;

class ResourceController extends Controller
{
    /*====================================NOTE=======================================================*/
    // Please check Resource_Paginate.md
    // Please check PostResource.php
    /*===========================================================================================*/

    /**
     * Return all posts
    */
    public function index(Request $request): JsonResponse
    {
        try {
            $postCollection = Post::paginate($request->input('per_page'));

            // Here is the magic part. though we are not pass the postresource in json response below
            // laravel will convert the data as in PostResource format not direct raw postCollection
            // No need to write extra code in PostResource for pagination.
            // Pagination will work as expected.
            PostResource::collection($postCollection);

            return response()->json([
                'status' => 'success',
                'data' => $postCollection
            ]);

        } catch (ModelNotFoundException|QueryException|Exception $exception){
            return response()->json($exception->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Return single post
    */
    public function show(string $slug): JsonResponse
    {
        try {
            $postModel = Post::where('slug', $slug)->firstOrFail();

            $postResource = PostResource::make($postModel);

            return response()->json([
                'status' => 'success',
                'data' => $postResource
            ]);

        } catch (ModelNotFoundException|QueryException|Exception $exception){
            return response()->json($exception->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }
}
