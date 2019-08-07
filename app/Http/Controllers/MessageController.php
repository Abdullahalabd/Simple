<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll(Conversation $conversation)
    {
        $messages = $conversation->messages->sortBy('created_at');
        return $messages;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'conversation_id'=>'required',
            'sender_id' =>'required',
            'content' =>'required',
        ]);
        $message_1 = new \App\Message($request->all());
        $message_2 = new \App\Message($request->all());
        $message_1->save();
        $message_2->conversation_id = $message_1->conversation->parallel_id;
        $message_2->save();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return $message;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
       return $message->delete();
    }
    public function default($id, $parallel_id)
    {

        $data = array(
            'conversation_id' => $id,
            'sender_id'=> 1,
            'content' => ' You are connected Say Hi :)',
        );
        $message_1 = new \App\Message($data);
        $message_2 = new \App\Message($data);
        $message_1->save();
        $message_2->conversation_id = $message_1->conversation->parallel_id;
        $message_2->save();
    }

}