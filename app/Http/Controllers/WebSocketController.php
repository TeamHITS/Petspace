<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketController extends Controller implements MessageComponentInterface{
    private $connections = [];
    
     /**
     * When a new connection is opened it will be passed to this method
     * @param  ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn){
        $this->connections[$conn->resourceId] = compact('conn') + ['user_id' => null];
    }
    
     /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn){
        $disconnectedId = $conn->resourceId;
        unset($this->connections[$disconnectedId]);
        foreach($this->connections as &$connection)
            $connection['conn']->send(json_encode([
                'offline_user' => $disconnectedId,
                'from_user_id' => 'server control',
                'from_resource_id' => null
            ]));
    }
    
     /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e){
        $userId = $this->connections[$conn->resourceId]['user_id'];
        echo "An error has occurred with user $userId: {$e->getMessage()}\n";
        unset($this->connections[$conn->resourceId]);
        $conn->close();
    }
    
     /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $conn The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $conn, $msg){
       
         echo $msg;
        $data = json_decode($msg);
        if (isset($data->command)) {
            switch ($data->command) {
                case "subscribe":
                    $this->subscriptions[$conn->resourceId] = $data->channel;
                break;
                case "groupchat":
                    //
                    // $conn->send(json_encode($this->subscriptions));
                    if (isset($this->subscriptions[$conn->resourceId])) {
                        $target = $this->subscriptions[$conn->resourceId];
                        foreach ($this->subscriptions as $id=>$channel) {
                            if ($channel == $target && $id != $conn->resourceId) {
                                $this->users[$id]->send($data->message);
                            }
                        }
                    }
                break;
                case "message":
                    //
                    if ( isset($this->userresources[$data->to]) ) {
                        foreach ($this->userresources[$data->to] as $key => $resourceId) {
                            if ( isset($this->users[$resourceId]) ) {
                                $this->users[$resourceId]->send($msg);
                            }
                        }
                        $conn->send(json_encode($this->userresources[$data->to]));
                    }

                    if (isset($this->userresources[$data->from])) {
                        foreach ($this->userresources[$data->from] as $key => $resourceId) {
                            if ( isset($this->users[$resourceId])  && $conn->resourceId != $resourceId ) {
                                $this->users[$resourceId]->send($msg);
                            }
                        }
                    }
                break;
                case "register":
                    //
                    if (isset($data->userId)) {
                        if (isset($this->userresources[$data->userId])) {
                            if (!in_array($conn->resourceId, $this->userresources[$data->userId]))
                            {
                                $this->userresources[$data->userId][] = $conn->resourceId;
                            }
                        }else{
                            $this->userresources[$data->userId] = [];
                            $this->userresources[$data->userId][] = $conn->resourceId;
                        }
                    }
                    $conn->send(json_encode($this->users));
                    $conn->send(json_encode($this->userresources));
                break;
                default:
                    $example = array(
                        'methods' => [
                                    "subscribe" => '{command: "subscribe", channel: "global"}',
                                    "groupchat" => '{command: "groupchat", message: "hello glob", channel: "global"}',
                                    "message" => '{command: "message", to: "1", message: "it needs xss protection"}',
                                    "register" => '{command: "register", userId: 9}',
                                ],
                    );
                    $conn->send(json_encode($example));
                break;
            }
        }
    }
}
