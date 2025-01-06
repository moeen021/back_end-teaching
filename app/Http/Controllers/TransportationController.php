<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeArticleRequest;
use App\Http\Requests\StoreTransportationRequest;
use App\Http\Resources\TransportationResource;
use App\Models\Transportation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransportationController extends Controller
{
    public function StoreTransportation(StoreTransportationRequest $storeTransportationRequest)
    {
        $transportation = Transportation::create($storeTransportationRequest->all());
        if ($storeTransportationRequest->hasFile('picture'))
        {
             $pictureUrl = Storage::putFile('/transportation',$storeTransportationRequest->picture);
        }
    }

    public function show($id)
    {
        $transportation = Transportation::find($id);
        if ($transportation == null)
        {
            return response()->json(
                [
                    'message'=>"محصول مورد نظر موجود نمیباشد!",
                ]
                ,404);
        }
        else
        {
            return response()->json(
                [
                    "message"=>"محصول مورد نظر موجود میباشد",
                    "data"=>new TransportationResource($transportation)
                ]
            );
        }
        /*return new TransportationResource($transportation);*/
    }
}
