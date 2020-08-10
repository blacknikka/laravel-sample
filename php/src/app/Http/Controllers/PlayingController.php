<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayingController extends Controller
{
    /**
     * session情報を表示
     *
     * @param  Request  $request
     * @return Response
     */
    public function show(Request $request)
    {
        if ($request->session()->has('key')) {
            $data = $request->session()->all();
            var_dump($data);
            echo 'you have a session' . PHP_EOL;
            $value = $request->session()->get('key');
        } else {
            $request->session()->regenerate();
            $data = $request->session()->all();
            var_dump($data);
            $request->session()->put('key', 'value');
            echo 'we created a new session' . PHP_EOL;
            $value = $request->session()->get('key');
        }
        echo $value;
    }
}
