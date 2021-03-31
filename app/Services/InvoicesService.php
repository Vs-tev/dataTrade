<?php

namespace App\Services;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoicesService{

    public function generateInvoice($payment, $plan){

        $customer = new Buyer([
            'name'          => $payment->user->name,
            'custom_fields' => [
                'email' => $payment->user->email,
            ],
        ]);

        $item = (new InvoiceItem())->title('Subscription plan' . $plan->name . $plan->billing_period)->pricePerUnit(number_format($payment->total / 100,2));

        $invoice = Invoice::make()
            ->buyer($customer)
            ->filename('invoices/' . $payment->user->name)
            ->addItem($item);

        return $invoice->save();
    }
}