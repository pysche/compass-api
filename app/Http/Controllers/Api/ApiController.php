<?php

namespace App\Http\Controllers\Api;

use Response;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Route;

class ApiController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $request;
	protected $response;

	public function __construct(Request $request)
	{
		$this->request = $request;
        $this->response = response();
	}

	protected function jsonResult($data = null,$message = null)
    {
        $content = $data ? $data : [];

        $this->response = $this->response->json($content);
        $this->response->header('Pragma','no-cache')
        ->header('Cache-Control','no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        return $this->response;
    }
}
