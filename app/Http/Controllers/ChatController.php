<?php

namespace App\Http\Controllers;

use App\Room;
use App\File;
use App\Message;
use App\MessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function checkMessages()
    {
        $data['success'] = false;

        foreach (Auth::user()->messageNotifications->where('saw', false) as $messageNotification) {
            if ($messageNotification->message->room->deal->deal_state_id == 2) {
                $data['success'] = true;
                $data['rooms'][] = [
                    'name' => $messageNotification->message->room->name,
                    'url' => url('chat/' . $messageNotification->message->room->slug)
                ];
            }
        }

        if (isset($data['rooms'])) {
            foreach($data['rooms'] as $k => $v) {
                foreach($data['rooms'] as $key => $value) {
                    if ($k != $key && $v['name'] == $value['name']) {
                        unset($data['rooms'][$k]);
                    }
                }
            }
        }

        return $data;
    }

    public function show($slug)
    {
        $room = Room::with('deal', 'messages', 'users')->where('slug', $slug)->first();

        foreach ($room->messages as $message) {
            foreach ($message->messageNotifications as $messageNotification) {
                if ($messageNotification->user_id == Auth::user()->id) {
                    $messageNotification->saw = true;
                    $messageNotification->save();
                }
            }
        }

        return view('frontEnd.chat.show', compact('room'));
    }

    public function getMessages($id)
    {
        $room = Room::with('messages')->find($id);
        $messages = Message::with('user')->where('room_id', $id)->get();

        return response()->json([
            'messages' => $messages,
            'quantity' => $room->messages->count(),
            'success' => true
        ], 200);
    }

    public function sendMessage(Request $request, $id)
    {
        $room = Room::find($id);
        $data['success'] = false;

        if ($request->input('message')) {
            $message = Message::create([
                'message' => $request->input('message'),
                'user_id' => Auth::user()->id,
                'room_id' => $id
            ]);

            foreach ($room->users as $user) {
                if ($user->id == Auth::user()->id) {
                    MessageNotification::create([
                        'user_id' => $user->id,
                        'message_id' => $message->id,
                        'saw' => true
                    ]);
                } else {
                    MessageNotification::create([
                        'user_id' => $user->id,
                        'message_id' => $message->id,
                        'saw' => false
                    ]);
                }
            }

            $data['success'] = true;
        }

        return $data;
    }

    public function uploadFile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'document' => 'required'
        ]);

        if ($validator->passes()) {
            $room = Room::find($id);

            $fileName = "/uploads/rooms/{$room->id}/" . time() . '-' . $request->file('document')->getClientOriginalName();
            $request->file('document')->move(public_path("/uploads/rooms/{$room->id}/"), $fileName);

            $file = new File([
                'name' => $fileName
            ]);

            $room->files()->save($file);

            $data['success'] = true;

            return $data;
        }

        return $validator->errors()->all();
    }
}
