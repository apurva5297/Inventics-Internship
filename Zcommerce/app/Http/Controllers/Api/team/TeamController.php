<?php
namespace App\Http\Controllers\App\team;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;



class TeamController extends Controller
{
    public function your_team(Request $request, $id, $type)
    {
        $this->validate($_POST['key']);    
        if($type == 'Buyer')
        {

        }
        if($type == 'Seller')
        {
            $data = array();
            $request_array = array();
            //Check whether the user is owner of team or not
            
            $get_owner_shop = DB::table('team_members')->where(['team_member_id'=>$id,'role_id'=>'Owner','status'=>'accept'])->first();
            if(!empty($get_owner_shop)){
                //if owner :- get actual owner shop id who have their own gstin
            $shop_id = $get_owner_shop->shop_id;
                $team_member = DB::table('team_members')
                            ->join('users','users.id','=','team_members.team_member_id')
                            ->select('team_members.id as id','users.name','users.phone','team_members.team_member_id','team_members.role_id','team_members.status','team_members.primary_contact')
                            ->where('team_members.shop_id',$shop_id)
                            //->where('team_members.status','accept')
                            ->get();
                

                //get all his team members
                foreach($team_member as $row)
                {
                    $data[] = array(
                        'id'=>$row->id,
                        'name'=>$row->name,
                        'team_member_id'=>$row->team_member_id,
                        'phone' => $row->phone,
                        'role_id' => $row->role_id,
                        'status' => $row->status,
                        'primary_contact' => $row->primary_contact,
                    );
                }
            }

            //if user is not owner show his owner and other request with role and status
            else{
                $member_status = DB::table('team_members')->where(['team_member_id'=>$id,'status'=>'accept'])->first();

                
                if(!empty($member_status))
                {
                    $team_member=DB::table('team_members')
                                    ->join('users','users.id','=','team_members.team_member_id')
                                    ->select('team_members.id as id','users.name','users.phone','team_members.team_member_id','team_members.role_id','team_members.status','team_members.primary_contact')
                                    ->where('team_members.shop_id',$member_status->shop_id)
                                    //->where('team_members.status','accept')
                                    ->get();
                    foreach($team_member as $row)
                    {
                        $data[] = array(
                            'id'=>$row->id,
                            'name'=>$row->name,
                            'team_member_id'=>$row->team_member_id,
                            'phone' => $row->phone,
                            'role_id' => $row->role_id,
                            'status' => $row->status,
                            'primary_contact' => $row->primary_contact,
                        );
                    }
                }

                
                
                $all_request = DB::table('team_members')
                                ->join('users','users.shop_id','=','team_members.shop_id')
                                ->select('team_members.id as id','users.name','users.phone','team_members.team_member_id','team_members.role_id','team_members.status','team_members.primary_contact')
                                ->where('team_members.team_member_id',$id)
                                ->where('team_members.status','!=','accept')
                                ->get();
                
                foreach($all_request as $row)
                {
                    $request_array[] = array(
                        'id'=>$row->id,
                        'name'=>$row->name,
                        'team_member_id'=>$row->team_member_id,
                        'phone' => $row->phone,
                        'role_id' => $row->role_id,
                        'status' => $row->status,
                        'primary_contact' => $row->primary_contact,
                    );
                }
                

            }    
            
            echo '{"Status":"success","message":"Your request sent","error":"100001","data":'.json_encode($data).', "all_request":'.json_encode($request_array).'}';
            
        }
    }

    public function teamRequest(Request $request, $owner_id, $type)
    {
        $this->validate($_POST['key']);     
        if($type == 'Buyer')
        {

        }
        elseif($type == 'Seller')
        {

            //When Team member update their gstin he will autometically remove from all team and he can create their own Team
            $get_shop_id = DB::table('users')->where('id',$owner_id)->first();


            if($get_shop_id->phone == $request->phone)
            {
                echo '{"Status":"success","message":"You can not send request to your number","error":"000000"}';
                exit();
            }


            $shop_id= $get_shop_id->shop_id;
            //Does shop exist in team_member table having role_id as owner and having gstin number ($get_shop_id->gstin !='')
            $check_owner_exist = DB::table('team_members')->where(['shop_id'=>$shop_id,'team_member_id'=>$owner_id,'role_id'=>'Owner'])->first();
            if(empty($check_owner_exist))
            {
                $send_data = array(
                    'shop_id' => $shop_id,
                    'team_member_id' => $owner_id,
                    'role_id' => 'Owner',
                    'status' => 'accept',
                    'primary_contact' => 1,
                    );
                $result=DB::table('team_members')->insert($send_data);
            }
            
            // if(empty($check_owner_exist) && empty($get_shop_id->gstin))
            // {
            //     //neither owner nor having gstin number ask for gsting number to become owner
            //     echo '{"Status":"success","message":"Update GSTIN to be an owner","error":"000000"}';
            //     exit();
            // }

            if(!empty($check_owner_exist))
            {
                $shop_id= $check_owner_exist->shop_id;
                //Having ownership but not having gstin so he can create team member for his main shop
                
            }
            // if(!empty($check_owner_exist) && !empty($get_shop_id->gstin))
            // {
            //     //having ownership and having gstin also so he can create team member under his own shop id
            // }

            $check_member = DB::table('users')->where('phone',$request->phone)->first();
            if(!empty($check_member))
            {
                $member_id = $check_member->id;

                // if(!empty($check_member->gstin))
                // {
                //     echo '{"Status":"success","message":"Requested Member has their own team","error":"000000"}';
                //         exit();
                // }
            
                $check_member_exist = DB::table('team_members')->where('shop_id',$shop_id)->where('team_member_id',$member_id)->first();
                if(!empty($check_member_exist))
                {

                    if($check_member_exist->status == 'pending')
                    {
                        echo '{"Status":"success","message":"You have already send request","error":"000000"}';
                        exit();
                    }
                    elseif($check_member_exist->status == 'accept')
                    {
                        echo '{"Status":"success","message":"Already in your team","error":"000000"}';
                        exit();
                    }
                }
                else
                {
                    $send_data = array(
                        'shop_id' => $shop_id,
                        'team_member_id' => $member_id,
                        'role_id' => $request->role_id,
                        'status' => 'pending',
                        'primary_contact' => 0,
                        );
                    $result=DB::table('team_members')->insert($send_data);
                    echo '{"Status":"Success", "message":"Your request send to your member","error":"00000","data":'.json_encode($send_data).'}';  
                }
            }
            else
            {
                echo '{"Status":"failure","message":"Requested phone does not exist","error":"000000"}';
                exit();
            }
        }
    }
    public function updateRequestStatusByMember(Request $request, $id, $request_id)
    {
        $this->validate($_POST['key']);    
        $update_status = $request->update_status;
        $shop = DB::table('users')->where('id',$id)->first();
        $shop_id = $shop->shop_id;
            
        if($request->update_status == 'accept')
        {
            //if user accept request of other owner he will exit from previous group with status exit
            $check_existing_team = DB::table('team_members')->where(['team_member_id'=>$id, 'status'=>'accept'])->first();
            // if(!empty($check_existing_team))
            // {
            //     DB::table('team_members')->where(['team_member_id'=>$id, 'status'=>'accept'])->limit(1)->update(['status'=>'exit']);
            // }

            
            //Dissable All product of team members
            DB::table('products')->where('shop_id',$shop_id)->update(['active'=>'0']);
            DB::table('inventories')->where('shop_id',$shop_id)->update(['active'=>'0']);
        }
        if($update_status == 'exit')
        {
            DB::table('products')->where('shop_id',$shop_id)->update(['active'=>'1']);
            DB::table('inventories')->where('shop_id',$shop_id)->update(['active'=>'1']);
        }
        DB::table('team_members')->where('id',$request_id)->limit(1)->update(['status'=>$update_status]);

        //dissable_team_members_own product


        echo '{"Status":"success","message":"Requested Status Updated Successfully","error":"100001","data":""}';
    }

    public function updateRequestStatusByOwner(Request $request, $id, $member_id)
    {
        $this->validate($_POST['key']);
        $update_status = $request->update_status;
        //$id = Auth::user('id');
        $ownership_check = DB::table('team_members')->where(['team_member_id'=>$id, 'role_id'=>'Owner', 'status'=>'accept'])->first();
        if(!empty($ownership_check))
        {
            $check_main_owner = DB::table('users')->where('id',$id)->first();
            if($check_main_owner->shop_id == $ownership_check->shop_id)
            {
                $shop_id = $check_main_owner->shop_id;
                
                DB::table('team_members')->where(['shop_id'=>$shop_id,'id'=>$member_id])->limit(1)->update(['status'=>$update_status]);
                if($update_status == 'exit' || $update_status == 'pending')
                {
                    DB::table('products')->where('shop_id',$shop_id)->update(['active'=>'1']);
                    DB::table('inventories')->where('shop_id',$shop_id)->update(['active'=>'1']);
                }
                else
                {
                    DB::table('products')->where('shop_id',$shop_id)->update(['active'=>'0']);
                    DB::table('inventories')->where('shop_id',$shop_id)->update(['active'=>'0']);
                }

                echo '{"status":"success","message":"Status updated by Main Owner","error":"000000","data":""}';
            }
            else{
                if($member_id != $check_main_owner->id)
                {
                    //owner not having gstin can only update status of team member only
                    DB::table('team_members')->where(['shop_id'=>$check_main_owner->shop_id,'id'=>$member_id])->update(['status'=>$update_status]);
                    if($update_status == 'exit' || $update_status == 'pending')
                    {
                        DB::table('products')->where('shop_id',$shop_id)->update(['active'=>'1']);
                        DB::table('inventories')->where('shop_id',$shop_id)->update(['active'=>'1']);
                    }
                    else
                    {
                        DB::table('products')->where('shop_id',$shop_id)->update(['active'=>'0']);
                        DB::table('inventories')->where('shop_id',$shop_id)->update(['active'=>'0']);
                    }
                    
                    echo '{"status":"success","message":"Status updated","error":"000000","data":""}';
                }
            }
        }
        else{
            //not having rights to update status of any other team member
            echo '{"status":"failure","message":"You are not owner of team","error":"000000","data":""}';
        }
    }

    public function makePrimaryContact(Request $request, $id, $member_id)
    {
        $this->validate($_POST['key']);
        $ownership_check = DB::table('team_members')->where(['team_member_id'=>$id, 'role_id'=>'Owner', 'status'=>'accept'])->first();
        if(!empty($ownership_check))
        {
            $check_old_primary_contact = DB::table('team_members')->where(['shop_id'=>$ownership_check->shop_id,'primary_contact'=>1])->get();
            if(!empty($check_old_primary_contact))
            {
                foreach($check_old_primary_contact as $old_primary)
                {
                    DB::table('team_members')->where('shop_id',$ownership_check->shop_id)->update(['primary_contact'=>0]);
                }
            }
            DB::table('team_members')->where(['shop_id'=>$ownership_check->shop_id,'id'=>$member_id])->update(['primary_contact'=>1]);
            echo '{"Status":"success","message":"Primary Contact Updated","error":"000000","data":""}';
        }
        else{
            echo '{"status":"failure","message":"You are not owner of team","error":"000000","data":""}';
        }
    }

    public function makeOwner(Request $request, $id, $member_id)
    {
        $this->validate($_POST['key']);
        $ownership_check = DB::table('team_members')->where(['team_member_id'=>$id, 'role_id'=>'Owner', 'status'=>'accept'])->first();
        if(!empty($ownership_check))
        {
            $shop_id = $ownership_check->shop_id;
            DB::table('team_members')->where(['shop_id'=>$shop_id,'id'=>$member_id])->update(['role_id'=>'Owner']);
            echo '{"status":"success","message":"Primary Contact Updated","error":"000000","data":""}';
        }
        else
        {
            echo '{"status":"failure","message":"You are not owner of team","error":"000000","data":""}';
        }
    }
    
    public function validate($key)
    {
        if($key!="A123456789")
        {
            echo '{"Status":"failed","message":"invalid api key","error":"100001","data":""}';
            exit();
        }
    }
}
?>