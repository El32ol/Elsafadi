<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = auth()->user();
        // $notify_id = $request->query('notify_id');
        // if($notify_id)
        // {
        //     $notifications = $user->unreadNotifications()->find($notify_id);
        //     if($notifications)
        //     {
        //         $notifications->markAsRead();
        //     }
        // }
                // user can be finded by alot of ways 
        // 1 - $user = $request->user();
        // 2 .....
        $user = auth()->user();

        // $request->query($variables);
        $noty_id =$request->query('noty'); 

        // check if noty_id really in url or no
        if($noty_id) //if noty exieste = true
        {   
            // catch the noty id from unread notifications by id of notifications in her tabel 
            $notifications = $user->unreadNotifications()->find($noty_id);
            if($notifications) // if noty existed in un read notification 
            {
                //transform it to read
                $notifications->markAsRead();
            }
            // mark noty as read
        }

        return $next($request);
    }
}
