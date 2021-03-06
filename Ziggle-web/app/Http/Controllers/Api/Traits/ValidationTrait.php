<?php

namespace app\Http\Controllers\Api\Traits;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

Trait ValidationTrait{
    /*public function keyGenerator(){

        //$api_key = Str::random(20);
        return $this->processResponse('Api_Key',"y9O2fffDuVFFWgynkYwP",'success','This is your api_key');
       
       }*/
   
       public function get_connection_id(Request $request)
       {
          //echo $request->api_key;
           if($request->api_key=="y9O2fffDuVFFWgynkYwP")
           {
               $connection_id= Str::random(30);
               DB::table('connection_request')->insert(
                   ['connection_id' => $connection_id]
               );
   
               return $this->processResponse('Connection_id',$connection_id,'success','This is your connection id');
           }
           else{
   
               return $this->processResponse('Api_key_matching',null,'error','API_key not matched');
           }
       }
   
       public function connection_request(Request $request){
          
           $key = $request->connection_id;
           if($this->validate_connection_id($key)){
               return $this->processResponse('Connection',null,'success','Connection established');
           }
           else{
               return $this->processResponse('Connection',null,'erroe','Connection not established');
           }
       }
   
       private function validate_connection_id($key)
       {
          //echo $key;

          $connection=DB::table('connection_request')->where('connection_id',$key)->count();
          if($connection>0)
            return true;
          else
               return false;
       }
}