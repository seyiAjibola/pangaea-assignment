<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubscriptionService;
use App\Http\Requests\SubscribeRequest;
use App\Http\Requests\PublishRequest;

class PangaeaController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;

    }

    public function subscribe(SubscribeRequest $request, $topic)
    {
        $result = $this->subscriptionService->subscribeTopic($topic, $request->url);
        if(!$result) {
            $response = ['status' => $result];
            return response($response, 422);
        }
        $response = ['status' => true, 'data' => $result];
        return response($response, 200);
    }

    public function publish(PublishRequest $request, $topic)
    {
        $result = $this->subscriptionService->publishTopic($topic, $request->message);
        return ($result) ? response(['status' => $result, 'message' => 'Post published successfully and notification sent to subscribers'], 200) 
                        : response(['status' => $result], 422);
    }

}
