<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\Warehouse\WarehouseRepository;
use App\WarehouseZoneGroup;
use App\WarehouseBin;
use App\Warehouse;
use App\Http\Requests\Validations\CreateWarehouseRequest;
use App\Http\Requests\Validations\UpdateWarehouseRequest;
use Image;
use Carbon\Carbon;
use DB;
use Auth;


class WarehouseController extends Controller
{
    use Authorizable;

    private $model_name;

    private $warehouse;

    /**
     * construct
     */
    public function __construct(WarehouseRepository $warehouse)
    {
        parent::__construct();

        $this->model_name = trans('app.model.warehouse');

        $this->warehouse = $warehouse;
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = $this->warehouse->all();

        $trashes = $this->warehouse->trashOnly();

        return view('admin.warehouse.index', compact('warehouses', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.warehouse._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWarehouseRequest $request)
    {
        $this->warehouse->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = $this->warehouse->find($id);

        return view('admin.warehouse._show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = $this->warehouse->find($id);

        return view('admin.warehouse._edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, $id)
    {
        $this->warehouse->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->warehouse->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->warehouse->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->warehouse->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function IndexZoneGroup($id)
    {   
        // $data=Warehouse::with('podcasts')->get();
        $warehouses = Warehouse::find($id);
        $warehouseZoneGroup=$warehouses->warehouseZoneGroup;
        return view('admin.warehouse.index-zone-group', compact('warehouses', 'warehouseZoneGroup'));
    }

    public function CreateZoneGroup(Request $request)
    {
        WarehouseZoneGroup::create($request->all());
        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    public function EditZoneGroup($id)
    {
        $warehouse = WarehouseZoneGroup::find($id);
        return view('admin.warehouse._edit_zone_group', compact('warehouse'));
    }

    public function UpdateZoneGroup(Request $request,$id)
    {   
        $zonegroup = WarehouseZoneGroup::find($id);
        $zonegroup->name = $request->name;
        $zonegroup->active = $request->active;
        $zonegroup->save();
        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function DeleteZoneGroup($id)
    {
        WarehouseZoneGroup::destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));

    }

    public function IndexBin($id)
    {   
        $zonegroup = WarehouseZoneGroup::find($id);
        $bins = WarehouseBin::where('warehouse_zone_group_id',$id)->limit(20)->get();
        $warehouses = Warehouse::find($id);
        $warehouseZoneGroup=!empty($warehouses)>0?$warehouses->warehouseZoneGroup:array();
        return view('admin.warehouse.bin.index', compact('warehouses', 'warehouseZoneGroup','zonegroup','bins'));
    }

    
    public function CreateBin(Request $request)
    {   
        $validations=WarehouseBin::where(['code'=>$request->code,'warehouse_zone_group_id'=>$request->warehouse_zone_group_id])->get();

        if (count($validations)>0) {
             return back()->with('error', trans('Code Already Exists', ['model' => $this->model_name]));
        }
        WarehouseBin::create($request->all());
        return back()->with('success', trans('Bin Created Successfully', ['model' => $this->model_name]));
    }

    public function EditBin($id)
    {
        $bin = WarehouseBin::find($id);
        return view('admin.warehouse.bin._edit_bin', compact('bin'));
    }

    public function UpdateBin(Request $request,$id)
    {
        $bin = WarehouseBin::find($id);
        $bin->name = $request->name;
        $bin->code = $request->code;
        $bin->active = $request->active;
        $bin->save();
        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function DeleteBin($id)
    {
        WarehouseBin::destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function BinCsvshowForm($id=0)
    {   
        return view('admin.warehouse.bin._upload_form',compact('id'));

    }

    public function ImportBinTemplate(Request $request)
    {
        $path = $request->file('products')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $data=array();
        $i=0;
        foreach ($rows as $result) {
            if ($i != 0) {
                if (isset($result[1]) && $result[2] !='') {
                    $bin=WarehouseBin::where(['code'=>$result[2],'warehouse_zone_group_id'=>$request->id])->get();
                    /*check*/
                    if (count($bin)==0) {
                       $data[]=array(
                        'warehouse_zone_group_id'=>$request->id,
                        'name'=>$result[1],
                        'code'=>$result[2],
                        'active'=>1,
                        'created_at'=>Carbon::now()->toDateTimeString(),
                        'updated_at'=>Carbon::now()->toDateTimeString()
                        );
                    }  
                }
            }
            $i++;
        }
        if (DB::table('warehouses_bin')->insert($data)) {
            return back()->with('success', trans('Bin Import Successfully', ['model' => $this->model_name]));
        }
        return back()->with('error', trans('Something Went Wrong', ['model' => $this->model_name]));
    }

    public function DownloadBinTemplate()
    {
       $csv_data[] = array('No','Bin Name','Bin code');
       $this->generateCsvFiles('bin_import_csv.csv',$csv_data);
    }

    function generateCsvFiles($file_name='realcube.csv',$data=array()){
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$file_name);
        $output = fopen('php://output', 'w');
        if (count($data) > 0) {
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
        }
        exit();
    }

    public function IndexBinConsolidateData(Request $request)
    {
        $columns = array( 
                0 =>'name', 
                1 =>'code',
                2=> 'zone_name',
                3=> 'status',
                4=> 'option',
            );
          
        /*is shop*/
        $id = $request->warehouse_zone_group_id;
        $zonegroup = WarehouseZoneGroup::find($id);
        if (Auth::user()->merchantId()) {
            $totalData = WarehouseBin::where('warehouse_zone_group_id',$id)->count();
                        
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value')))
            {            
                $posts = WarehouseBin::where('warehouse_zone_group_id',$id)->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
            }else {
               $search = $request->input('search.value'); 

                $posts =  WarehouseBin::where('warehouse_zone_group_id',4)
                             ->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = WarehouseBin::where('warehouse_zone_group_id',4)
                             ->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                             ->count();
            }
        }else{
            /*admin*/
            $totalData = WarehouseBin::count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            
            if(empty($request->input('search.value')))
            {            
                $posts = WarehouseBin::offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $posts =  WarehouseBin::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = WarehouseBin::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('code', 'LIKE',"%{$search}%")
                             ->count();
            }
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $bin)
            {   
                $option = view( 'admin.warehouse.bin.option', compact('bin'))->render();
                $nestedData['name'] = $bin->name;
                $nestedData['code'] = $bin->code;
                $nestedData['zone_name'] = $zonegroup->name;
                $nestedData['status'] = $bin->active = 1 ? 'Active':'In-Active';
                $nestedData['options'] = $option;
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }

}
