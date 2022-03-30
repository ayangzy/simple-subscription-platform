<?php

namespace App\Actions;

use App\Mail\SubscriptionMail;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\SubscriptionEmail;
use Illuminate\Support\Facades\Mail;

class SendMails
{
    public function sendEmails(Post $post)
    {
        $subcribers = Subscription::where('website_id', $post->website_id)->get();

        foreach ($subcribers as $subscibe) {

            $user_has_received_topic = $this->checkDuplicateStory($subscibe->email, $post->id);

            if ($user_has_received_topic) {
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
