<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRquest;
use App\Mail\SubscriptionMail;
use App\Models\Subscription;
use App\Models\SubscriptionEmail;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    use ApiResponses;

    public function store(CreatePostRquest $request)
    {
        $createPost = Post::create($request->validated());
        if (!$createPost) {
            return $this->badRequestAlert('Unable to create post. Please try again');
        }

        $this->sendEmails($createPost);

        return $this->createdResponse('Post created successfully', $createPost);
    }

    private function sendEmails(Post $post)
    {
        $subcribers = Subscription::where('website_id', $post->website_id)->get();

        foreach ($subcribers as $subscibe) {

            $user_has_subcribed = $this->checkDuplicateStory($subscibe->email, $post->id);

            if ($user_has_subcribed) {
                continue;
            }

            $this->createSendPost($subscibe->email, $post->id);
            Mail::to($subscibe->email)->send(new SubscriptionMail($post->title));
        }
    }

    private function checkDuplicateStory($email, $post_id)
    {
        return SubscriptionEmail::where('email', $email)->where('post_id', $post_id)->first();
    }

    private function createSendPost($email, $post_id): void
    {
        SubscriptionEmail::create([
            'email' => $email,
            'post_id' => $post_id
        ]);
    }
}
