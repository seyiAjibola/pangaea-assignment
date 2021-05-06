<?php
namespace App\Services;

use App\Models\Subscription;
use App\Notifications\PangaeaNotification;
use Illuminate\Support\Facades\Notification;

class SubscriptionService
{
    protected $model;

    public function __construct(Subscription $model)
    {
       $this->model = $model;
    }

    public function subscribeTopic($topic, $url)
    {
        $subscribe = $this->model->where('topic', $topic)->first();
        $subscribe->update(['url' => $url]);
        if($subscribe) {
            return [
                'topic' => $topic,
                'url' => $url,
            ];
        }

        return false;
    }

    public function publishTopic($topic, $message)
    {
        $publish = $this->model->where('topic', $topic)->first();
        $publish->update(['message' => $message]);
                
        if($publish) {
            $user = $publish->users;
            $publishedData = [
                'topic' => $publish->topic,
                'url' => $publish->url,
                'message' => $publish->message
            ];
            Notification::send($user, new PangaeaNotification($publishedData));
            return true;
        }

        return false;
    }

}