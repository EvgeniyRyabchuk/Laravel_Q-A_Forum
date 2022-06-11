<?php

namespace App\Http\Controllers;

use App\_SL\Utils;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    //TODO: check if rate already exist by user
    // simple rate - like or dislike
    public function simpleRate(Request $request, $lang, $targetId)
    {
        $user = Auth::user();
        $rateType = $request->post('rateType');
        $rateTarget = $request->post('rateTarget');

        $model = Utils::getModelByTableName($rateTarget);
        $target = $model::findOrFail($targetId);
//        $rate = new Rate();
//        $rate->user()->save($user);
//        $rate->rateable_type = $rateType;
//        $rate->rateable_id = $rateType;

        $result = $target->rates()->create([
            'user_id' => $user->id,
            'type' => $rateType
        ]);

        return response()->json([
                'msg' => "Evaluation success",
                "rate" => $result
            ]
            , 201);
    }
}
