<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', auth()->id())->select(['id', 'name', 'email'])->first();
        $users = User::where('id', '!=', auth()->id())->get();
        return view('home', ['user' => $user, 'users' => $users]);
    }

    public function messages($rid){
        $messages = Message::with('user')
        ->where(function ($query) use ($rid) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $rid);
        })
        ->orWhere(function ($query) use ($rid) {
            $query->where('sender_id', $rid)
                ->where('receiver_id', auth()->id());
        })
        ->orderBy('created_at', 'asc')
        ->get();
        return response()->json([
            'messages' => $messages
        ]);
    }

    public function message(Request $request){
        try {
            $message = Message::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->get('receiver_id'),
                'text' => $request->get('text')
            ]);
            SendMessage::dispatch($message);
    
            return response()->json([
                'success' => true,
                'message' => 'Message created and job dispatched'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th
            ]);
        }
    }

    public function users(){
        $users = User::where('id', '!=', auth()->id())->get();
        return response()->json([
            'users' => $users
        ]);
    }
}
