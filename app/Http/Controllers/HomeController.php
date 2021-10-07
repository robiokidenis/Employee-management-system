<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        return view('dashboard');
    }
    public function quotes()
    {
        return view('quotes' ,['quotes'=>  collect($this->get_quotes())->random(50)]);
        # code...
    }
    protected  function get_quotes()
    {
        $client = new Client();
        $response = $client->get('https://zenquotes.io/api/quotes');
        return json_decode($response->getBody());
    }
    public function displayImage($filename)
    {
        // return 'a';
        $path = storage_path('images/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
