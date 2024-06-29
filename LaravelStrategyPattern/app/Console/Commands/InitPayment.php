<?php

namespace App\Console\Commands;

use App\Service\PaymentService;
use Illuminate\Console\Command;

class InitPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paymentMethodStripe = "stripe";
        $paymentServiceService = new PaymentService($paymentMethodStripe);
        $this->info($paymentServiceService->pay());
        $paymentMethodapaypal = "paypal";
        $PaypalPaymentService = new PaymentService($paymentMethodapaypal);
        $this->info($PaypalPaymentService->pay());
        $InvalidPaymentMethod = "invalid";
        $InvalidPaymentMethodService = new PaymentService($InvalidPaymentMethod);
        $this->info($InvalidPaymentMethodService->pay());
    }
}
