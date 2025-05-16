<?php

namespace App\Http\Controllers;

use NotificationChannels\WebPush\PushSubscription;
use Illuminate\Http\Request;

class WebPushController extends Controller
{
    public function subscribe(Request $request)
    {
        $user = auth()->user();

        $subscription = new PushSubscription([
            'endpoint' => $request->endpoint,
            'public_key' => $request->public_key,
            'auth_token' => $request->auth_token,
            'content_encoding' => $request->content_encoding,
        ]);

        //Associa a subscrição ao utilizador
        $user->pushSubscriptions()->save($subscription);

        return response()->json(['message' => 'Subscribed successfully']);
    }
}
