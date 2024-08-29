<?php


namespace App\Http\Traits;



trait GenaralApiTrait
{


    public function returnError($errNum , $msg)
    {

        return response()->json([
            'status'=> false ,
            'errNum'=> $errNum ,
            'msg' => $msg

        ]);

    }


    public function returnSuccessMessage($errNum ="5000", $msg="")
    {

        return response()->json([
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg

        ]);

    }


    public function returnData($key, $value, $msg)
    {
        return response()->json([
            'status' => true,
            'errNum' =>"5000",
            'msg' => $msg,
             $key => $value

        ]);
    }

    public function returnValidationError()
    {

    }




}
