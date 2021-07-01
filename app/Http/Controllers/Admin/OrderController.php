<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $result['orders']=DB::table('orders')
        ->select('orders.*','orders_status.orders_status')
        ->leftjoin('orders_status','orders_status.id','=','orders.order_status')
        ->get();
        //prx($result);
        return view('admin.order',$result);
    }

    public function order_details(Request $result,$id){
        $result['orders_detalis']=
        DB::table('orders_detalis')
        ->select('orders.*','sizes.size','orders_status.orders_status','colors.color','orders_detalis.price','orders_detalis.qty','products.name as pname','product_attr.image_attr')
        ->leftjoin('orders','orders.id','=','orders_detalis.order_id')
        ->leftjoin('product_attr','product_attr.id','=','orders_detalis.product_attr_id')
        ->leftjoin('products','products.id','=','product_attr.product_id')
        ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
        ->leftjoin('colors','colors.id','=','product_attr.color_id')
        ->leftjoin('orders_status','orders_status.id','=','orders.order_status')
        ->where('orders.id',$id)
        ->get();
        //prx($result['orders_detalis']);

        $result['payment_status']=['Pending','Success','Fail'];

       

        $result['order_status']=DB::table('orders_status')
            ->get();
        return view('admin.order_details',$result); 
    }
    function update_payment_status(Request $result,$status,$id){
        DB::table('orders')->where(['id'=>$id])->update(['payment_status'=>$status]);
        return redirect('/admin/order_details/'.$id);
    }

    function update_order_status(Request $result,$status,$id){
        DB::table('orders')->where(['id'=>$id])->update(['order_status'=>$status]);
        return redirect('/admin/order_details/'.$id);
    }
    function update_track_details(Request $result,$id){
        DB::table('orders')->where(['id'=>$id])->update(['track_details'=>$result->post('track_details')]);
        return redirect('/admin/order_details/'.$id);
    }
    
    
}
