<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\SWAPI\SWAPIConnector;
use Illuminate\Http\Request;

class SWAPIController extends Controller
{
    //List methods
    public function getResourceList(Request $request, SWAPIConnector $connector)
    {
        $resource = $connector->{$request->route('resource')}();
        $resourceList = $resource->list();
        return response()->json($resourceList);
    }

    //Get:id methods
    public function getResource(Request $request, SWAPIConnector $connector)
    {
        $resource = $connector->{$request->route('resource')}();
        $resourceGet = $resource->get($request->route('id'));
        return response()->json($resourceGet);
    }

    //Schema methods
    public function getResourceSchema(Request $request, SWAPIConnector $connector)
    {
        $resource = $connector->{$request->route('resource')}();
        $resourceGet = $resource->schema();
        return response()->json($resourceGet);
    }

}
