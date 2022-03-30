<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRquest;
use App\Traits\ApiResponses;

class PostController extends Controller
{
    use ApiResponses;
    
    public function store(CreatePostRquest $request)
    {
        $createPost = Post::create($request->validated());

        return $this->createdResponse('Post created successfully', $createPost);
    }
}
