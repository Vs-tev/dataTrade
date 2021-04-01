<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChargeSuccessNotification extends Notification
{
    use Queueable;

    private $payment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    /* public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    } */

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
       /*  $message = (new MailMessage)
            ->line('Your invoice is now available! '.number_format($this->payment->total / 100, 2). 'Eur')
            ->line(" We've attached a copy of your invoice for your records. ")
            ->line('Thank you for using our application!');
            $filename = storage_path('app/invoices/'. $this->payment->user_id . '.pdf'); 
            if(file_exists($filename)){
                $message->attach($filename);
            }
            
            return $message; */

            $message = (new MailMessage)
            ->line('Your invoice is now available!')
            ->line(" We've attached a copy of your invoice for your records. ")
            ->line('Thank you for using our application!');
            
            return $message;



    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
