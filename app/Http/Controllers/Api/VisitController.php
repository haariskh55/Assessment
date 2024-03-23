<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrackVisitRequest;
use App\Http\Requests\updateStageRequest;
use App\Service\VisitService;
use App\Http\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    use JsonResponseTrait;

    protected $service;
    public function __construct(VisitService $service)
    {
        $this->service = $service;
    }
    
    public function trackVisit($externalId)
    { 
        try{
            DB::beginTransaction();

             $this->service->trackVisit($externalId);

            DB::commit();
            return $this->sendResponse();
        } catch(Exception $e){
            DB::rollBack();
            return $this->sendError('Something went wrong.' .$e->getMessage());
        }
    }

    public function updateStage(updateStageRequest $request)
    {
        try{
            DB::beginTransaction();
             $this->service->updateStage($request);

            DB::commit();
            return $this->sendResponse();
        } catch(Exception $e){
            DB::rollBack();
            return $this->sendError('Something went wrong.' .$e->getMessage());
        }
       
    }
}
