<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Support\Facades\Storage;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions=Subscription::with('subscribable','teacher','user')->paginate(6);
        return view('admin.subscription.index',compact('subscriptions'));
    }
    public function show(Subscription $subscription)
    {
        return view('admin.subscription.show',compact('subscription'));
    }
    public function update(UpdateSubscriptionRequest $request,Subscription $subscription)
    {
        $subscription->status=$request->status;
        $subscription->save();
        if($subscription->status==1){
            $subscription->teacher->balance=$subscription->teacher->balance-$subscription->price;
            $subscription->teacher->save();
        }
        return to_route('subscriptions.index',compact('subscription'));
    }
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        Storage::disk('public')->delete($subscription->image);
        return to_route('subscriptions.index',compact('subscription'));
    }
}
