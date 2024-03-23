<?php

namespace App\Service;

use App\Models\Visit;
use Exception;

class VisitService
{

    public function trackVisit($externalId)
    {
        // Attempt to find an existing visit by external_id
        $visit = Visit::where('external_id', $externalId)->first();
      
        // If the visit doesn't exist, return an error response
        if (!$visit) {
           
           throw new Exception('External ID is not found.Please try again');
        }
       
        // If the visit does exist, update the updated_at timestamp
        $visit->updated_at = now();
        $visit->save();

        return $visit;
    }

    public function updateStage($request)
    {
       return Visit::updateOrCreate(
            ['external_id' => $request['externalId']],
            ['stage' => $request['stage']]
        );
    }
}