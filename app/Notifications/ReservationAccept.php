<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class ReservationAccept extends Notification
{
    use Queueable;

    public  $item_id;
    public $company_id;
    public $form;
    public $to;
    public $form_time;
    public $to_time;
    public function __construct($data)
    {
        $this->company_id = Auth::user()->id;
        $this->item_id = $data->item_id;
        $this->form = $data->from;
        $this->to = $data->to;
        $this->form_time = $data->from_time;
        $this->to_time = $data->to_time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'items_id' => $this->item_id,
            'company_id' => $this->company_id,
            'from' => $this->form,
            'to' => $this->to,
            'from_time' =>$this->form_time,
            'to_time' =>$this->to_time,
            'status' =>'Accepted'
        ];
    }
}
