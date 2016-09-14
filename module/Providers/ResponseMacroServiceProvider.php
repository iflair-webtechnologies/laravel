<?php

namespace Villato\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use stdClass;

class ResponseMacroServiceProvider extends ServiceProvider
{


    public function boot()
    {
        Response::macro('ajax', function ($result = null, $error = '') {
            $output = new stdClass();
            $output->success = true;
            $output->result = $result;
            $output->error = $error;

            return Response::json($output);
        });
    }

    public function register()
    {
        //
    }
}