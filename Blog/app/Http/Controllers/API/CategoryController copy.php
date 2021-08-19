<?php

			namespace App\Http\Controllers\API;

			use App\Http\Controllers\Controller;
			use Illuminate\Http\Request;
			use App\Category;
			use Illuminate\Support\Str;
			use App\User;
			use Illuminate\Support\Facades\DB;
			use App\Traits\ResponseTrait;

class CategoryController extends Controller
			{
				use ResponseTrait;

				public function check_connection($connection_id,$name,$email,$password)
				{
			
					$valid= DB::table('connection_request')->where('connection_id',$connection_id)->first();
					if($valid)
					{
						$user =new User;
						$user->name=$name;
						$user->email=$email;
						$user->password=$password;
						$user->save();
						$a_code=Str::random(6);
						DB::table('connection_request')->where('connection_id',$connection_id)
						->update(['user_id'=>$user->id,'auth_code'=>$a_code]);
						$user->auth_code=$a_code;
						return $user;
					}
					else
					return false;
		
				}
				public function check_user($connection_id,$auth_code)
				{
					$valid=DB::table('connection_request')->where('connection_id',$connection_id)->where('auth_code',$auth_code)->first();
					if($valid)
					{
						$a_code=Str::random(6);
						DB::table('connection_request')->where('connection_id',$connection_id)
						->update(['auth_code'=>$a_code]);
						$connection= DB::table('connection_request')->where('connection_id',$connection_id)->first();
						return $connection;
					}
					else
					return false;
				}
				public function index(Request $request)
				{
					$categories=Category::all();
					$response=$this->response('Category List',$categories,'1000');
					return $response;
				}

				public function create(Request $request)
				{
					$category=new Category;
					if($request->name==null||$request->description==null)
					{
						return $this->response('Name or Description Missing',json_encode($category),'1001');
					}
					else if(Category::where('name',$request->name)->first())
					{
						return $this->response('Name already exist',json_encode($category),'1001');
					}
					$str=strtolower($request->name);
					$slug = preg_replace('/\s+/', '-', $str);
					$random = Str::random(5);
					$category->slug=$slug.$random;
					$category->name=$request->name;
					$category->description=$request->description;
					$category->save();  
					return $this->response('success',$category,'1001');
				}
				
				public function edit(Request $request)
				{
					if($request->name==null || $request->description==null)
					return $this->response('Name or Description Missing',null,'1002');
					$category=Category::where('slug',$request->slug)->first();
					if(!$category)
					return $this->response('category not found',null,'1002');
					$str=strtolower($request->name);
					$slug = preg_replace('/\s+/', '-', $str);
					$random = Str::random(5);
					$category->slug=$slug.$random;
					$category->name=$request->name;
					$category->description=$request->description;
					$category->save();
					return $this->response('category updated',$category,'1000');
				}

				public function delete(Request $request)
				{
					$category=Category::where('slug',$request->slug)->first();
					if(!$category)
					return $this->response('category not found',$category,'1002');
					$category->delete();
					return $this->response('category deleted',$category,'1000'); 
				}

				private function response($msg,$data=null,$code)
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
