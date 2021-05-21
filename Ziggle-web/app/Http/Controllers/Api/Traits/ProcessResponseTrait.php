<?php
namespace app\Http\Controllers\Api\Traits;

Trait ProcessResponseTrait{
    public function processResponse($key="data",$data=null,$status,$message=null){
        
        if($status=='success'){
            return response()->json([
                'status'=>$status,
                 $key=>$data,
                'message'=>$message,
                'code'=>202,
            ]);
                
        }
        else{
            return response()->json([
                'status'=>$status,
                'message'=>$message,
                'code'=>404,
            ]);
        }
    }

}

?>