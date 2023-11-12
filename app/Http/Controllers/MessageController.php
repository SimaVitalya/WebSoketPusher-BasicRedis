<?php

namespace App\Http\Controllers;

use App\Events\StoreMessageEvent;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageRerource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        $messages = MessageRerource::collection($messages)->resolve();
        return inertia('Message/Index', compact('messages'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $message = Message::create($data);
        broadcast(new StoreMessageEvent($message))->toOthers();//1) мы сосдали StoreMessageEvent далее мы его вызываем тут потом переходим в StoreMessageEvent и смотрим что дальше.2)use broadcast and toOthers что бы не дублировалось сообщенгие
        return MessageRerource::make($message)->resolve();
    }
}
