<?php

namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatEvent extends Event implements ShouldBroadcast {

    public $text;

    public function __construct($text) {
        $this->text = $text;
    }

    public function broadcastOn() {
        return ['chat'];
    }

}
