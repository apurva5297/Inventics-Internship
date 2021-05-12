<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Product;
use App\Inventory;
use App\Category;
use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Rap2hpoutre\FastExcel\FastExcel;

class Facebook extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $failed_list = [];
    protected $url;


    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    public function getPost(Request $request)
    {   
        $access_token=$request->access_token;
        
        //"https://graph.facebook.com/v3.2/me?fields=posts.limit(2)%7Bfull_picture%2Cattachments%7D&access_token=EAACnTAS3HWMBADNof1NmYWnxZCZBRsofuM1KZAM3QQXpSIww4d5yRAnsRJSeuKQ5dfJZB6tNPABBWO3PhLZCbKZAW9oQdWtPAEUeoao3BtlYnfsyE1dP9GPD8ZB3pXxQB9ctANABfxrcgGG4ezXZAt1YtyDz3quPARZAlpftSXjia3XMbFwTfSSzVxMuDGTtV93cZD"

        //$url = "https://graph.facebook.com/v3.2/me?fields=posts.limit(2)%7Bfull_picture%2Cattachments%7D;
        $url = "https://graph.facebook.com/v3.2/me?fields=posts.limit(3)%7Bfull_picture%2Cattachments%7D";
        $url .="&access_token=".$access_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        
        $data=$response_a['posts']['data'];

        //all posts
        foreach($data as $post) {

            //$file = $data['full_picture'];
            // $this->upload_image($file);
            //$message=$data['message'];
            $subattachments=$post['attachments']['data'][0]['subattachments'];
            
            //all products in single post
            foreach ($subattachments['data'] as $product) {
                $payload=array(
                    'title'=>$product['title'],
                    'image'=>$product['media']['image']['src'],
                    'description'=>$product['description'],
                );
                DB::table('fb_products')->insert($payload);
            }
        }
        
    }

    public function extract(){
        //get 10 products
        $products = DB::table('fb_products')->where('status','pending')->offset(0)->limit(5)->get();
        foreach ($products as $product) {
            $payload=array(
                "title"=>$product->title,
                "description"=>$product->description,
                "image"=>$this->upload_image($product->image)
            );

            // insert into read_product
            DB::table('read_products')->insert($payload);
        }
    }

    public function upload_image($file)
    {
        // Open the file to get existing content
        $data = file_get_contents($file);

        $file_name=$this->generate_random(40);

        $new = '/var/www/html/storage/app/public/images/'. $file_name.'.jpg';

        // Write the contents back to a new file
        file_put_contents($new, $data);

        $url='http://206.189.141.143/image/images/'. $file_name.'.jpg';
        return $url;
    }

   public function generate_random($length = 10) {
        $alphabets = range('A','Z');
        $numbers = range('0','9');
        $final_array = array_merge($alphabets,$numbers);
             
        $password = '';
      
        while($length--) {
          $key = array_rand($final_array);
          $password .= $final_array[$key];
        }
       return $password;
    }

    public function import()
    {
        $this->failed_list = [];
        $category_list= 56;

        $products = DB::table('read_products')->where('status','pending')->offset(3)->limit(1)->get();

        foreach ($products as $product) {
            $result=$this->createProduct($category_list,$product);
            echo json_encode($result);
            $final_result=$this->createInventory($result,$product->image);
            echo json_encode($final_result);
        }

        $failed_rows = $this->getFailedList();

        if(!empty($failed_rows))
            echo json_encode($failed_rows);
    }
   
    public function createInventory($data,$image)
    {
        $key[]=1;
        $inventory = Inventory::create([
                        'shop_id'=>11,
                        'title'=>$data->name,
                        'warehouse_id'=>2,
                        'product_id'=>$data->id,
                        'brand'=>$data->brand,
                        'supplier_id'=>6,
                        'sku'=>$data->model_number,
                        'condition'=>'New',
                        'condition_note'=>'Latest Collection',
                        'description'=>$data->description,
                        'key_features'=>$key,
                        'stock_quantity'=>1,
                        'damaged_quantity'=>NULL,
                        'user_id'=>5,
                        'purchase_price'=>50,
                        'sale_price'=>100,
                        'offer_price'=>NULL,
                        'offer_start'=>NULL,
                        'offer_end'=>NULL,
                        'shipping_weight'=>500,
                        'free_shipping'=>1,
                        'min_order_quantity'=>1,
                        'slug'=>$data->slug,
                        'meta_title'=>$data->name,
                        'meta_description'=>$data->description,
                        'stuff_pick'=>NULL,
                        'active'=>1
                    ]);

        $inventory->saveImageFromUrl($image, NULL);

        return $inventory;
    }

    /**
     * Create Product
     *
     * @param  array $product
     * @return App\Product
     */
    private function createProduct($category_list,$data)
    { 
        $model_number=$this->generate_random();
        // Create the product.  has_variant=1 or 0
        $product = Product::create([
                        'name' => $data->title,
                        'slug' => str_slug($data->title, '-').'-'.$model_number,
                        'model_number' => $model_number,
                        'description' => $data->description,
                        'gtin' => $model_number,
                        'gtin_type' => 'UPC',
                        'mpn' => $model_number,
                        'brand' => 'Wookie',
                        'origin_country' => 356,
                        'manufacturer_id' => 9,
                        'min_price' => 0,
                        'max_price' => NULL,
                        'requires_shipping' => 1,
                        'shop_id' => 11,
                        'active' => 1,
                        'has_variant'=>1,
                    ]);


        // Sync categories
        if($category_list)
            $product->categories()->sync($category_list);

        // Upload featured image
        if ($data->image)
            $product->saveImageFromUrl($data->image, true);

        // Sync tags
        /*if($data['tags'])
            $product->syncTags($product, explode(',', $data['tags']));*/

        return $product;
    }
    public function mapping(Request $request)
    {
        $products=json_decode($request->products,true);
        $category=explode('-',$request->category);  //$category[1]
        $i=0;
        foreach ($products as $product) {
            $product_id=explode('-',$product); //$product_id[1]
            DB::table('category_product')
            ->where('product_id', $product_id[1])
            ->update(['category_id' => $category[1]]);
            $i++;
        }
        echo "Total ".$i." Products Mapped Successfully!";
    }
    private function pushIntoFailed(array $data, $reason = Null)
    {
        $row = [
            'data' => $data,
            'reason' => $reason,
        ];

        array_push($this->failed_list, $row);
    }

    private function getFailedList()
    {
        return $this->failed_list;
    }
}
