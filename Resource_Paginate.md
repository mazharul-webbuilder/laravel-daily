# Laravel Resource Collections and Responses for Auto Pagination using Resource class for api response

## Overview

In Laravel, resource collections provide an elegant way to transform your data when preparing it for JSON serialization. This transformation process is streamlined by leveraging Laravel's `JsonResource`, which automatically applies your specified transformations when constructing HTTP responses.

#### Please check PostResource.php file and ResourceController

        try {
            $postCollection = Post::paginate($request->input('per_page'));

            // Here is the magic part. though we are not pass the postresource in json response below
            // laravel will convert the data as in PostResource format not direct raw postCollection
            // No need to write extra code in PostResource for pagination.
            // Pagination will work as expected.
            PostResource::collection($postCollection);

            return response()->json([
                'status' => 'success',
                'data' => $postCollection // data will format as explain in PostResource
            ]);

        } catch (ModelNotFoundException|QueryException|Exception $exception){
            return response()->json($exception->getMessage(),Response::HTTP_BAD_REQUEST);
        }

## Lazy Evaluation and Automatic Transformation

When you call `PostResource::collection($posts);` in your controller, a new resource collection instance is created. However, the transformation doesn't immediately occur due to Laravel's lazy evaluation. Instead, the transformation is deferred until the response is being serialized into JSON.

### Key Concepts

1. **Lazy Evaluation**: Resource collections in Laravel are lazily evaluated. This means that when you call `PostResource::collection($posts);`, the transformation doesn't happen right away. Laravel waits until the response is being serialized to apply the transformation.

2. **Automatic Transformation**: When you pass a paginator instance (e.g., `$posts`) directly to the `response()->json()` method, Laravel detects that it's a paginated collection. Because you have previously called `PostResource::collection()`, Laravel automatically transforms each item in the paginated result.

3. **Middleware and Response Handling**: Laravel's response middleware inspects the response data for instances of `JsonResource`. It applies the `toArray()` transformation as the response is prepared, ensuring that all resources and collections are transformed when returned as a JSON response.

## Example: Automatic Resource Transformation

Here is a step-by-step explanation of how Laravel handles your resource transformation:

1. **Paginator Creation**: The line `$posts = BlogPost::paginate(2);` generates a `LengthAwarePaginator` instance containing raw data from the database.

2. **Resource Collection**: When you invoke `PostResource::collection($posts);`, Laravel wraps the paginator in a resource collection, preparing the data for transformation without immediately applying it.

3. **Response Serialization**: Calling `response()->json(...)` prompts Laravel's response system to check the data type. Given that the paginator is encapsulated in a resource collection, Laravel applies the `toArray()` method defined in your `PostResource` to transform each item.

4. **Final Output**: The transformed data, complete with pagination metadata, is serialized into JSON and returned as the response.

## Conclusion

This process highlights the efficiency and elegance of using resource collections in Laravel. By leveraging automatic transformations and lazy evaluations, you can ensure that your responses are consistently formatted and optimized for API consumption.
