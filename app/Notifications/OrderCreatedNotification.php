<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
       return ["mail"];

     //   $channels = ['database'];

     //   if($notifiable->notifications_prefrences['order_created']['sms'] ?? false){
     //       $channels[] = 'vontage';
    //    }
        
     //   if($notifiable->notifications_prefrences['order_created']['mail'] ?? false){
     //       $channels[] = 'mail';
    //    }
        
     //   if($notifiable->notifications_prefrences['order_created']['broadcast'] ?? false){
    //        $channels[] = 'broadcast';
    //    }

    //    return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $userdata = $this->order->billingAddress;
        return (new MailMessage)
                    ->subject("New Order Created # {$this->order->number}")
                    ->greeting("Hi {$notifiable->name}")
                    ->line("A new Order (#{$this->order->name}) Created by {$userdata->first_name} From {$userdata->country}")
                    ->action('View Order', url('/dashboard'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
