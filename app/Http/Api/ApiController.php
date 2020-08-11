<?php


namespace App\Http\Api;


use App\Http\Controllers\Controller;
use Illuminate\Container\Container;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    protected $acceptsHeader;

    protected function adminCheck()
    {
        if(Auth()->user()->admin != 1){
            redirect(403);
        }
    }

    protected function formatResponse($response)
    {
        $request = Container::getInstance()->make('request');
        if(Str::contains($request->headers->get('Accept'), 'xml')){
            $xmlWrapper = [
                'status'=>'success',
                'data'=>$response->resolve()
            ];

            return response()->xml($xmlWrapper);

        }
        else{
            return $response;
        }
    }
}
