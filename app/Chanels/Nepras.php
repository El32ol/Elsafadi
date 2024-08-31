<?php 

namespace App\Chanels;

use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

class Nepras 
{
    protected $baseUrl = 'https://www.nsms.ps';

    public function send ($notifiable , Notification $notification)
    {
        $message = $notification->toNepras($notifiable);


        $response = Http::baseUrl($this->baseUrl)
            ->get('api.php', [
                'comm' => 'sendsms',
                'user'=>config('services.nepras.user'),
                'pass'=>config('services.nepras.pass'),
                'to'=>$notifiable->routeNotificationForNepras(),
                'message'=> $message,
                'sender'=> config('services.nepras.sender'),
            ]);

            $code = $response->body();
            if($code != 1)
            {
                throw new Exception($code);
            }

    }
}