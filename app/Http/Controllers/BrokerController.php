<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class BrokerController extends Controller{
    private $connection;
    private $channel;

    public function __construct(){
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    public function send(){
        return view('send');
    }

    public function send_message(Request $request){
        $rules = [
            'message' => 'required|max:250'
        ];

        $message = [
            'message.required' => 'Message harus diisi',
            'message.max' => 'Message harus kurang dari :max karakter'
        ];

        $this->validate($request, $rules, $message);

        $message = new AMQPMessage($request->message);
        $this->channel->basic_publish($message, '', 'hello');

        flash('Message : "' . $request->message . '" berhasil dikirim')->success();

        $this->channel->close();
        $this->connection->close();
        return redirect()->back();
    }

    public function receive(){
        $this->channel->queue_declare('hello', false, false, false, false);
        echo "[*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($message){
            echo '[x] Received Message: ', "\n", $message->body, "\n";
        };

        $this->channel->basic_consume('hello' , '', false, true, false, false, $callback);

        while($this->channel->is_consuming()){
            $this->channel->wait();
        }
    }
}
