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

        $payload = [ 
            'query' => ['token' => env('SLACK_WEB_TOCKEN')],
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded']            
        ];
        $resposne = $this->client->request('GET','conversations.list',$payload);
    
        return json_decode($resposne->getBody());
     }

    public function channelsInvite($user, $channel){
        // dd($user,$channel);
        $payload = [ 
            'query' => ['token' => env('SLACK_WEB_TOCKEN')],
            'form_params' => [
                'channel' => $channel,
                'user' => $user
                 ], 
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; application/json;']            
        ];

        $resposne = $this->client->request('POST','conversations.invite',$payload);
        echo $resposne->getBody();
        return $resposne->getBody();
     }
}
