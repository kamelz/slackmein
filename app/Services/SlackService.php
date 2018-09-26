<?php namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SlackService
{
    protected $client;
    protected $token;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client =  new Client(['base_uri' =>'https://slack.com/api/']);
    }

     public function channelsCreate($name){
        $payload = [
            'form_params' => ['name' => $name ], 
            'query' => ['token' => env('SLACK_WEB_TOCKEN')],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; application/json']            
        ];

        $resposne = $this->client->request('POST', "channels.create",$payload);
       
        return json_decode($resposne->getBody());
     }  

     public function testToken(){
        $payload = [ 
            'query' => [
                'token' => env('SLACK_WEB_TOCKEN'),
            ],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; application/json;']        
        ];
        $resposne = $this->client->request('POST','auth.test',$payload);
        echo $resposne->getBody();
        return json_decode($resposne->getBody());
     }

     public function channelsList(){
        $payload = [ 
            'query' => ['token' => env('SLACK_WEB_TOCKEN')],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded']            
        ];
        $resposne = $this->client->request('GET','channels.list',$payload);
    
        return json_decode($resposne->getBody());
     }
    public function inviteByEmail($email){
        $payload = [ 
            'query' => [
                // email invitaion require a 'client' scope which is provided by a legacy token
                'token' => env('SLACK_LEGACY_TOKEN'), 
            ],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; application/json;'],
            'form_params' => [
                'email' => $email
            ]            
        ];
        $resposne = $this->client->request('POST','users.admin.invite',$payload);
        return json_decode($resposne->getBody());

    }

    public function channelsInvite($user, $channel){
        $payload = [ 
            'query' => [
                'token' => env('SLACK_WEB_TOCKEN'),
            ],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; application/json;'],
            'form_params' => [
                'channel' => $channel,
                'user' => $user
            ]            
        ];
        $resposne = $this->client->request('POST','channels.invite',$payload);
        return json_decode($resposne->getBody());
     }
}
