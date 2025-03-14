<?php

namespace App\Listeners;

use App\Events\SubscriptionCanceled;
use App\Events\SubscriptionCreated;
use App\Services\SubscriptionRoleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserRoleOnSubscriptionChange implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The subscription role service instance.
     *
     * @var SubscriptionRoleService
     */
    protected $subscriptionRoleService;

    /**
     * Create the event listener.
     *
     * @param SubscriptionRoleService $subscriptionRoleService
     * @return void
     */
    public function __construct(SubscriptionRoleService $subscriptionRoleService)
    {
        $this->subscriptionRoleService = $subscriptionRoleService;
    }

    /**
     * Handle the subscription created event.
     *
     * @param SubscriptionCreated $event
     * @return void
     */
    public function handleSubscriptionCreated(SubscriptionCreated $event)
    {
        $this->subscriptionRoleService->updateUserRole($event->subscription->user);
    }

    /**
     * Handle the subscription canceled event.
     *
     * @param SubscriptionCanceled $event
     * @return void
     */
    public function handleSubscriptionCanceled(SubscriptionCanceled $event)
    {
        $this->subscriptionRoleService->updateUserRole($event->subscription->user);
    }
}
