<?php

namespace App\Http\Controllers\subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSubscriptionRequest;
use App\Models\Subscription;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    use ApiResponses;
    public function subscribe(UserSubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->validated());

        return $this->createdResponse('Post has been subscribed to successfully', $subscription);
    }
}
