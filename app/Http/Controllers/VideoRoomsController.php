<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\{
    Jwt\AccessToken,
    Jwt\Grants\VideoGrant,
    Rest\Client as TwilloClient
};


class VideoRoomsController extends Controller
{
    protected $sid;
    protected $token;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->key = config('services.twilio.key');
        $this->secret = config('services.twilio.secret');
    }

    public function index()
    {
        $rooms = [];

        try {
            $twillo = new TwilloClient($this->sid, $this->token);
            $allRooms = $twillo->video->rooms->read([]);

            $rooms = array_map(function($room) {
                return $room->uniqueName;
            }, $allRooms);
        } catch (\Exception $e) {
            echo 'Error: '. $e->getMessage();
        }

        return view('index', ['rooms' => $rooms]);
    }
}
