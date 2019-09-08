<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class Reservation extends Notification
{
    use Queueable;

    public $item_id;
    public $user_id;
    public $company_id;
    public $form;
    public $to;
    public $form_time;
    public $to_time;
    public function __construct($item , $data)
    {
        $this->user_id = Auth::user()->id;
        $this->item_id = $item->id;
        $this->company_id = $item->user;
        $this->form = $data['from'];
        $this->to = $data['to'];
        $this->form_time = $data['from_time'];
        $this->to_time = $data['to_time'];
    }


    public function via($notifiable)
    {
        return ['database'];
    }


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
            'item_id' => $this->item_id,
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'from' => $this->form,
            'to' => $this->to,
            'from_time' =>$this->form_time,
            'to_time' =>$this->to_time
        ];
    }
}
