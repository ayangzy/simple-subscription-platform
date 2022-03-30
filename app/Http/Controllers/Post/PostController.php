<?php

namespace App\Http\Controllers\Post;

use App\Actions\SendMails;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRquest;
use App\Traits\ApiResponses;

class PostController extends Controller
{
    use ApiResponses;

    public function store(CreatePostRquest $request)
    {
        $createPost = Post::create($request->validated());
        if (!$createPost) {
            return $this->badRequestAlert('Unable to create post. Please try again');
        }

        (new SendMails())->sendEmails($createPost);
        
        return $this->createdResponse('Post created successfully', $createPost);
    }
}
