<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Update Post
    */
    public function updatePost(int $postId, Request $request): JsonResponse
    {
        try {
            $postModel = Post::findOrFail($postId);

            //authorize single auth application
            $this->authorize('update', $postModel); // if fail will throw exception check, Handler.php file on App/Exception to get details

            // authorize for multi-auth application
            $this->authorizeForUser($request->user('admin'), 'update', $postModel);

            $postModel->update($request->all());

            return response()->json(['message' => 'Updated successfully']);

        } catch (ModelNotFoundException|\Exception $exception){
            return response()->json(['message' => $exception->getMessage()]);
        }
    }
    // Please check Policy_Single_and_Multi_auth.md, AuthServiceProvider.php and Handler.php to get details

}
