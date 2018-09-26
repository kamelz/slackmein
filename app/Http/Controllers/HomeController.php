<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\SlackService;
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
     * @return \Illuminate\Http\Response
     */
    public function index(SlackService $service)
    {

        $channels = $service->channelsList()->channels;
        
        return view('home')->with(['channels' => $channels]);
    }

    /**
     * Creates a slack channel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,SlackService $service)
    {
        $validatedData = $request->validate([
            'channel' => 'required',
        ]);
        $response = $service->channelsCreate($validatedData['channel']);
         return redirect()->back()->with([
            'status' => $response->ok == true?'Channel created Successfully!':'Error while creating channel!',
             'log' => json_encode($response)
            ]);
    }

    /**
     * Invite a slack member to a channel.
     *
     * @return \Illuminate\Http\Response
     */
    public function inviteToChannel(Request $request,SlackService $service)
    {
        $validatedData = $request->validate([
            'channel' => 'required',
            'user' => 'required',
        ]);

        $response = $service->channelsInvite($validatedData['user'],$validatedData['channel']);
        return redirect()->back()->with([
            'status' => $response->ok == true?'Invitation sent!':'Invitation failed!',
            'log' => json_encode($response)
            ]);
    }

    /**
     * Invite a slack member by email.
     *
     * @return \Illuminate\Http\Response
     */
    public function inviteByEmail(Request $request,SlackService $service)
    {
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);
        $response = $service->inviteByEmail($validatedData['email']);
        return redirect()->back()->with([
            'status' => $response->ok == true?'Invitation sent!':'Invitation failed!',
            'log' => json_encode($response)
            ]);
    }

}
