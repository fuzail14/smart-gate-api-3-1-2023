<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societybuilding;

use Illuminate\Support\Facades\Validator;


class SocietyBuildingController extends Controller
{
    //
    public function addsocietybuilding(Request $request)
    {
        $isValidate = Validator::make($request->all(), [

            'subadminid' => 'required|exists:users,id',
            'societyid' => 'required|exists:societies,id',
            'superadminid' => 'required|exists:users,id',
            'societybuildingname' => 'required',

            'dynamicid' => 'required'

        ]);

        if ($isValidate->fails()) {
            return response()->json([
                "errors" => $isValidate->errors()->all(),
                "success" => false
            ], 403);
        }

        $societybuildingresident = new Societybuilding;

        $societybuildingresident->subadminid = $request->subadminid;
        $societybuildingresident->societyid = $request->societyid;
        $societybuildingresident->superadminid = $request->superadminid;

        $societybuildingresident->societybuildingname = $request->societybuildingname;
        $societybuildingresident->dynamicid = $request->dynamicid;



        $societybuildingresident->save();




        return response()->json(
            [

                "success" => true,
                "message" => "Society Building Register to our system Successfully",
                "data" => $societybuildingresident,

            ]
        );
    }




    public function societybuildings($dynamicid)
    {


        $societybuildingresident = Societybuilding::where('dynamicid', $dynamicid)->get();





        return response()->json([
            "success" => true,
            "data" => $societybuildingresident,

        ]);
    }
}
