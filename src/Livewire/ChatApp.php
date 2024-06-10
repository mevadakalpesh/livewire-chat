<?php

namespace App\Livewire\ChatApp;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Events\ChatApp\TypingEvent;
use Livewire\WithFileUploads;
use App\Events\ChatApp\SendMessagEvent;
use App\Events\ChatApp\UnreadMessageEvent;
use Illuminate\Support\Facades\Storage;

class ChatApp extends Component
{
    use WithFileUploads;

    public $receiver_id = null;
    public $sender_id = null;
    public $message_text = '';
    public $typing = false;
    public $userTyping = [];
    public $unreadMessage = [];
    public $medias = [];
    public $emojyBoradClass = 'hidden';



    public function getListeners()
    {
        return [
            "echo:user_message-{$this->sender_id},.SendMessagEvent" => "sendMesageReload",
            "echo:typing-{$this->sender_id}-{$this->receiver_id},.TypingEvent" => "typingStatus",
            "echo:receiver-typing-{$this->sender_id},.ReceiverTypingEvent" => "userTypingArray",
            "echo:receiver-unreaddata-{$this->sender_id},.UnreadMessageEvent" => "unreadReceiverData",
            "set-emoji" => "appendEmoji",
        ];
    }


    public function onFocusTyping()
    {
        $data = [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'typing_status' => true,
        ];
        TypingEvent::dispatch($data);
        $this->dispatch('scroll_top', [auth()->user()->id, $this->receiver_id]);
    }


    public function onBulrTyping()
    {
        $data = [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'typing_status' => false,
        ];
        TypingEvent::dispatch($data);
        $this->dispatch('scroll_top', [auth()->user()->id, $this->receiver_id]);
    }



    public function mount($userid = null)
    {


        $this->receiver_id = $userid;
        $this->sender_id = auth()->user()->id;
        $userData =  User::where('id', $this->receiver_id)->where('id', '!=', $this->sender_id)->first();

        abort_if(blank($userData) && $userid != null, 404, 'this user is not vaild');
    }

    public function render()
    {
        $users = User::where('id', '!=', $this->sender_id)->get();
        $messages = Message::where(function ($query1) {
            $query1->where('receiver_id', $this->receiver_id)
                ->where('sender_id', $this->sender_id);
        })
            ->orWhere(function ($query2) {
                $query2->where('sender_id', $this->receiver_id)
                    ->where('receiver_id', $this->sender_id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        $receiver = User::where('id', $this->receiver_id)->first();


        return view('livewire.chat-app.chat-app', [
            'users' => $users,
            'messages' => $messages,
            'receiver' => $receiver,
        ])->layout('layouts.app');
    }



    public function sendMessage()
    {

        $images = $this->fileUpload();


        if (!blank($this->message_text) || !blank($this->medias)) {
            $data = [
                'sender_id' => $this->sender_id,
                'receiver_id' => $this->receiver_id,
                'message' => $images . $this->message_text,
                'message_text' => $this->message_text
            ];
            SendMessagEvent::dispatch($data);
            // $data['count'] = 0;
            UnreadMessageEvent::dispatch($data);
            $this->message_text = null;
            $this->medias = [];
            $this->emojyBoradClass = 'hidden';
            $this->dispatch('scroll_top', [auth()->user()->id, $this->receiver_id]);
        }
    }


    public function sendMesageReload()
    {
        $this->dispatch('$refresh');
        $this->dispatch('scroll_top', [auth()->user()->id, $this->receiver_id]);
    }

    public function userTypingArray($data)
    {
        $this->userTyping[$data['data']['sender_id']] = $data['data'];

        if ($data['data']['typing_status'] === false) {
            unset($this->userTyping[$data['data']['sender_id']]);
        }
    }

    public function  typingStatus($data)
    {
        $this->typing = $data['data']['typing_status'];
        $this->dispatch('scroll_top', [auth()->user()->id, $this->receiver_id]);
    }

    public function unreadReceiverData($data)
    {

        if (!isset($this->unreadMessage[$data['data']['sender_id']]['count'])) {
            $data['data']['count'] = 0;
        } else {
            $data['data']['count'] = $this->unreadMessage[$data['data']['sender_id']]['count'];
        }

        $this->unreadMessage[$data['data']['sender_id']] = $data['data'];

        $this->unreadMessage[$data['data']['sender_id']]['count'] += 1;
    }

    public function fileUpload()
    {
        $images = '<div class="flex flex-col gap-3">';
        $medias =  $this->medias;


        if (!blank($medias)) {
            foreach ($medias as $medias) {
                $file_name = $medias->hashName();
                Storage::putFileAs('/public/chat-media/', $medias, $file_name);
                $image_full_path = '/storage/chat-media/' . $file_name;
                $images .= '<img  src="' . $image_full_path . '" width="150"  height="150"/>';
            }
        }
        $images .= "</div><br/>";
        return $images;
    }


    public function removeImage($key)
    {
        unset($this->medias[$key]);
    }

    public function emojyboradToggle()
    {
        if ($this->emojyBoradClass) {
            $this->emojyBoradClass = null;
        } else {
            $this->emojyBoradClass = 'hidden';
        }
    }

    public function appendEmoji($emoji)
    {
        $this->message_text .= $emoji;
    }
}
