<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response.
     *
     * @return \Illuminate\Http\Response
     */
    public function success($data=null, $message=null)
    {
        $response = (object)config('messages.api.success');
        $response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 200);
    }

    /**
     * created response.
     *
     * @return \Illuminate\Http\Response
     */
    public function created($data=null, $message=null)
    {
    	$response = (object)config('messages.api.created');
        $response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 201);
    }

    /**
     * no content response.
     *
     * @return \Illuminate\Http\Response
     */
    public function no_content($data=null, $message=null)
    {
    	$response = (object)config('messages.api.no_content');
        $response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 204);
    }

    /**
     * bad request response.
     *
     * @return \Illuminate\Http\Response
     */
    public function bad_request($data=null, $message=null, $status='bad_request')
    {
        $response = (object)config('messages.api.'. $status);
        $response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 400);
    }

    /**
     * unauthourised response.
     *
     * @return \Illuminate\Http\Response
     */
    public function unauthorised($data=null, $message=null, $status='unauthorised')
    {

    	$response = (object)config('messages.api.'. $status);
        $response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 401);
    }

    /**
     * forbidden response.
     *
     * @return \Illuminate\Http\Response
     */
    public function forbidden($data=null, $message=null, $status='forbidden')
    {

    	$response = (object)config('messages.api.'. $status);
        $response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 403);
    }

    /**
     * not found response.
     *
     * @return \Illuminate\Http\Response
     */
    public function not_found($data=null, $message=null)
    {
        $response = (object)config('messages.api.not_found');
    	$response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 404);
    }

    /**
     * duplicate response.
     *
     * @return \Illuminate\Http\Response
     */
    public function duplicate($data=null, $message=null, $status='duplicate')
    {
        $response = (object)config('messages.api.'. $status);
    	$response->data = $data;
        $response->message = $message==null?$response->message:$message;

        return response()->json($response, 409);
    }

    /**
     * server error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function server_error(\Throwable $th=null)
    {
    	$response = (object)config('messages.api.server_error');

        Log::error($th->getMessage());
        return response()->json($response, 500);
    }
}
