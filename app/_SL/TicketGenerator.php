<?php

namespace App\_SL; 

class TicketGenerator {
    public static function getTicket($user, $remember_me) {
        $minutes = env('APP_AUTH_TICKET_EXPIRATION_MINUTE');
        $ticket = [
            'id' => $user->id, 
            'name' => $user->name, 
            'email' => $user->email, 
            'issue' => date('Y-m-d H:i:s'), 
            'expire' => $minutes, 
            'remember_me' => $remember_me
        ]; 
        return $ticket; 
    }
}