<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessTrialEndPayments extends Command
{
    protected $signature = 'subscriptions:process-trial-end-payments';
    protected $description = 'Process payments for subscriptions whose trial period is ending today';

    public function handle()
    {
        // Find subscriptions whose trial ends today
        $subscriptions = Subscription::with('payments')
            ->where('trial_ends_at', '>=', Carbon::today())
            ->where('trial_ends_at', '<', Carbon::tomorrow())
            ->where('status', 'active')
            ->get();

        $this->info("Found {$subscriptions->count()} subscriptions with trials ending today.");

        foreach ($subscriptions as $subscription) {
            // Find the trial payment for this subscription
            $trialPayment = $subscription->payments()
                ->where('status', 'trial')
                ->first();

            if ($trialPayment) {
                // Here you would integrate with your payment processor to charge the customer
                // For this example, we'll just update the status
                $trialPayment->update([
                    'status' => 'completed',
                    'notes' => 'Subscription payment for ' . $subscription->plan->name . ' (Trial ended on ' .
                              Carbon::today()->format('M d, Y') . ')',
                ]);

                $this->info("Processed payment {$trialPayment->id} for subscription {$subscription->id}");
            }
        }

        return Command::SUCCESS;
    }
}
