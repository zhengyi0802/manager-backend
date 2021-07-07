<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\ProductStatus;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                        ->leftJoin('product_types', 'type_id', 'product_types.id')
                        ->leftJoin('projects', 'proj_id', 'projects.id')
                        ->leftJoin('product_statuses', 'status_id', 'product_statuses.id')
                        ->select('products.*', 'product_types.name as type_name',
                          'projects.name as project_name',
                          'product_statuses.name as status_name')->paginate(5);
        if ($products) {
            foreach($products as $product) {
                $mac_array = str_split($product->ether_mac, 2);
                $macaddress = implode(':', $mac_array);
                $product->ether_mac = $macaddress;
            }
        }
        return view('products.index',compact('products'))
              ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productTypes = DB::table('product_types')->get();
        $productStatuses = DB::table('product_statuses')->get();
        $projects = DB::table('projects')->get();

        return view('products.create', compact('productTypes'))
               ->with(compact('productStatuses'))
               ->with(compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required',
            'wifi_mac' => 'required',
            'status_id' => 'required',
        ]);

        $ether_mac = str_replace(":", "", $request->input('ether_mac'));
        $ether_mac = strtoupper($ether_mac);
        $request->merge(array('ether_mac' => $ether_mac));

        $wifi_mac = str_replace(":", "", $request->input('wifi_mac'));
        $wifi_mac = strtoupper($wifi_mac);
        $request->merge(array('wifi_mac' => $wifi_mac));

        Product::create($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $productType = ProductType::where('id', $product->type_id)->first();
        $productStatus = ProductStatus::where('id', $product->status_id)->first();
        $project = Project::where('id', $product->proj_id)->first();
        $proj_name = ($project != null) ? $project->name : '--------';
        $mac_array = str_split($product->ether_mac, 2);
        $ether_mac = implode(':', $mac_array);
        $product->ether_mac = $ether_mac;
        $mac_array1 = str_split($prodyct->wifi_mac, 2);
        $wifi_mac = implode(":", $mac_array1);
        $product->wifi_mac = $wifi_mac;

        return view('products.show',compact('product'))
               ->with('proj_name', $proj_name)
               ->with('type_name', $productType->name)
               ->with('status_name', $productStatus->name);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productTypes = DB::table('product_types')->get();
        $productStatuses = DB::table('product_statuses')->get();
        $projects = DB:: table('projects')->get();
        $mac_array = str_split($product->ether_mac, 2);
        $ether_mac = implode(':', $mac_array);
        $product->ether_mac = $ether_mac;
        $mac_array1 = str_split($prodyct->wifi_mac, 2);
        $wifi_mac = implode(":", $mac_array1);
        $product->wifi_mac = $wifi_mac;

        return view('products.edit', compact('product'))
               ->with(compact('productTypes'))
               ->with(compact('projects'))
               ->with(compact('productStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'wifi_mac' => 'required',
            'type_id' => 'required',
            'status_id' => 'required',
        ]);

        $ether_mac = str_replace(":", "", $request->input('ether_mac'));
        $ether_mac = strtoupper($ether_mac);
        $request->merge(array('ether_mac' => $ether_mac));

        $wifi_mac = str_replace(":", "", $request->input('wifi_mac'));
        $wifi_mac = strtoupper($wifi_mac);
        $request->merge(array('wifi_mac' => $wifi_mac));

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function register(Request $request)
    {
        $mac = $request->input('mac');
        //$mac = str_replace(':', '', $request->input('mac'));
        $mac = strtoupper($mac);

        $products = Product::where('ether_mac', '=', $mac)
                           ->orWhere('wifi_mac', '=', $mac)
                           ->latest()
                           ->get();

        $str = "https://mundifar.com/mundi/API/index_api.php?mac=".$mac."&token=Wg7DZTmTapH2Ww2sAeNfmhhfXzYqEt6Y";
        $response = Http::get($str);
        $obj = json_decode(substr($response->body(), 3));

        if ($obj->sno == "") return $response->body();

        if ($products->count() > 0) {
            foreach ($products as $product) {
                $product->proj_id     = ($obj->project_id=='') ? 0:$obj->project_id;
                $product->expire_date = $obj->exp_date;
                $product->status_id   = ($obj->status=='n') ? 1:2;
                $product->save();
            }
        } else {
            $product = new Product;
            $product->type_id     = 0;
            $product->serialno    = $obj->sno;
            $product->ether_mac   = $obj->mac;
            $product->wifi_mac    = $obj->wmac;
            $product->proj_id     = ($obj->project_id=='') ? 0:$obj->project_id;
            $product->expire_date = $obj->exp_date;
            $product->status_id   = ($obj->status=='n') ? 1:2;
            $product->save();
        }

        return json_encode($product);
    }

    public function query(Request $request)
    {
        if ($request->input('mac')) {
            $mac = $request->input('mac');
            //$mac = str_replace(':', '', $request->input('mac'));
            $mac = strtoupper($mac);
        } else {
          $mac = "001A79A75F37";
        }

        $str = "https://mundifar.com/mundi/API/index_api.php?mac=".$mac."&token=Wg7DZTmTapH2Ww2sAeNfmhhfXzYqEt6Y";
        //$str1 = "https://mundifar.com/mundi/API/index_api.php?mac=001A79A75F37&token=Wg7DZTmTapH2Ww2sAeNfmhhfXzYqEt6Y";

        $response = Http::get($str);

        //$a = array("sno"=>"1812SP003131", "mac"=> "001A79A75F37", "wmac"=>"001A79A75F37", "sales_id"=>"", "project_id"=>"", "exp_date" => "2021-06-01 16:53:25", "status"=> "n", "message"=>"ok");

        $str1=substr($response->body(), 3);

        //var_dump(json_decode($str1));

        return json_encode($str1);
    }

}
