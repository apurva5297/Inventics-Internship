<?php

namespace App\Traits;
trait ResponseTrait
{
    public function response($msg,$data=null,$code)
    {
        if($data){
            $status='success';
            return ['status'=>$status,'message'=>$msg,'data'=>$data,'code'=>$code];
        }
        else
        {
        $status='failed';
        return ['status'=>$status,'message'=>$msg,'data'=>$data,'code'=>$code];
        }
    }
}