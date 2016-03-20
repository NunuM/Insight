<?php

namespace App\Http\Controllers;


use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller {

    var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat';

    public function __construct() {
        $this->pusher = App::make('pusher');
        $this->middleware('auth');
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }

    public function index() {
        $messages = \App\Message::orderBy('created_at', 'desc')->paginate(15);

        foreach ($messages as $message) {
            $message->user;
        }

        return Response::json($messages);
    }

    public function store(Request $request) {
        
        $post = \App\Message::create($request->all());
        
        $message = [
            'text' => e($post->text),
            'name' => Auth::user()->name,
            'avatar' => '$this->user->getAvatar()',
            'timestamp' => (time() * 1000)
        ];
        $this->pusher->trigger($this->chatChannel, 'new-message', $message);
    }

}
