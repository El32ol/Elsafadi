<?php

namespace App\Notifications;

use App\Chanels\log;
use App\Chanels\Nepras;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class NewProposalNotification extends Notification
{
    use Queueable;
    protected $proposal;
    protected $freelancer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal , User $freelancer)
    {
        $this->proposal = $proposal;
        $this->freelancer = $freelancer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // $via =  ['database', 'broadcast', 'vonage']; // mail not working with me (mailtrap)
        $via =  [Log::class , Nepras::class]; // custom notification chanel 

        if ($notifiable->notify_mail)
        {
            $via[] = 'mail';
        }
        if ($notifiable->notify_sms)
        {
            $via[] = 'nexmo';
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;
        $message   ->subject('E-lancer')
                    ->greeting('Hello')
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('project.show' , $this->proposal->project_id))
                    ->line('Thank you for using our application!');
                    return $message;
    }

    public function toDatabase($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        return [
            'title' =>'New Proposal',
            'body' =>$body,
            'icon' =>'icon-material-outline-group',
            'url' =>route('clients.show' , $this->proposal->project_id),
        ];
    }

    public function toBroadcast($notifiable)
    {
        // possibly it return array like database or depend on the natural of data
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        return new BroadcastMessage([
            'title' =>'New Proposal',
            'body' =>$body,
            'icon' =>'icon-material-outline-group',
            'url' =>route('clients.show' , $this->proposal->project_id),
        ]);
    }

    public function toVonage($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );

        $message = new VonageMessage();
        $message->content($body);
    
        return $message;
    }

    public function toLog($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
      
        return $body;
    }

    public function toNepras($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
      
        return $body;
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
