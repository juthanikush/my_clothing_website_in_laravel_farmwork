<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Mail;
class FrontController extends Controller
{
    
    public function index(Request $request)
    {
        $result['home_categories']=DB::table('categories')->where('is_home',1)->where('status',1)->get();

        foreach( $result['home_categories'] as $list){
            $result['home_categories_product'][$list->id]=
                    DB::table('products')
                    ->where(['status'=>1])
                    ->where(['category_id'=>$list->id])
                    ->get();

            foreach($result['home_categories_product'][$list->id] as $list1){
            
                    $result['home_product_attr'][$list1->id]=
                    DB::table('product_attr')
                    ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftjoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$list1->id)
                    ->get();
                
            
            }
        }
        $result['home_brand']=DB::table('brands')->where('is_home',1)->where('status',1)->get();

        $result['home_featured_product'][$list->id]=
                    DB::table('products')
                    ->where(['status'=>1])
                    ->where(['is_featured'=>1])
                    ->get();

            foreach($result['home_featured_product'][$list->id] as $list1){
            
                    $result['home_featured_product_attr'][$list1->id]=
                    DB::table('product_attr')
                    ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftjoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$list1->id)
                    ->get();
            }
         //   prx($result['home_featured_product_attr'][$list1->id]);

            $result['home_tranding_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_tranding'=>1])
            ->get();

            foreach($result['home_tranding_product'][$list->id] as $list1){
            
                    $result['home_tranding_product_attr'][$list1->id]=
                    DB::table('product_attr')
                    ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftjoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$list1->id)
                    ->get();
            }

            $result['home_discounted_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_discounted'=>1])
            ->get();

            foreach($result['home_discounted_product'][$list->id] as $list1){
            
                    $result['home_discounted_product_attr'][$list1->id]=
                    DB::table('product_attr')
                    ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftjoin('colors','colors.id','=','product_attr.color_id')
                    ->where('product_attr.product_id',$list1->id)
                    ->get();
            }
        
            $result['home_banner']=DB::table('home_banners')->where('status',1)->get();
        return view('front.index',$result);
    }
    public function category(Request $request,$slug)
    {
        $qry=DB::table('categories')->select('id')->where('category_slug',$slug)->get();
        
        $sort="";
        $sort_txt="";
        $filter_price_start="";
        $filter_price_end="";
        $color_filter="";
        $colorFilterArr=[];
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
        }
        
        
        $query=DB::table('products');
        $query=$query->leftJoin('categories','categories.id','=','products.category_id');
        $query=$query->leftJoin('product_attr','products.id','=','product_attr.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['categories.category_slug'=>$slug]);
        if($sort=='name'){
            $query=$query->orderBy('products.name','asc');
            $sort_txt="Product Name";
        }
        if($sort=='date'){
            $query=$query->orderBy('products.id','desc');
            $sort_txt="Date";
        }
        if($sort=='price_desc'){
            $query=$query->orderBy('product_attr.price','desc');
            $sort_txt="Price - DESC";
        }if($sort=='price_asc'){
            $query=$query->orderBy('product_attr.price','asc');
            $sort_txt="Price - ASC";
        }
        if($request->get('filter_price_start')!==null && $request->get('filter_price_end')!==null){
            $filter_price_start=$request->get('filter_price_start');
            $filter_price_end=$request->get('filter_price_end');

            if($filter_price_start>0 && $filter_price_end>0){
                $query=$query->whereBetween('product_attr.price',[$filter_price_start,$filter_price_end]);
            }

        }  

         if($request->get('color_filter')!==null ){
            $color_filter=$request->get('color_filter');
            $colorFilterArr=explode(":",$color_filter);
            $colorFilterArr=array_filter($colorFilterArr);
            //prx($colorFilterArr);
            $query=$query->where(['product_attr.color_id'=>$request->get('color_filter')]);
            
        }
        $query=$query->distinct()->select('products.*');
        $query=$query->get();
        $result['product']=$query;
        

        foreach($result['product'] as $list1){
           
                $query=DB::table('product_attr');
                $query=$query->leftjoin('sizes','sizes.id','=','product_attr.size_id');
                $query=$query->leftjoin('colors','colors.id','=','product_attr.color_id');
                $query=$query->where('product_attr.product_id',$list1->id);
                $query=$query->get();
                $result['product_attr'][$list1->id]=$query;
        }
     // prx($result);
        $result['colors']=DB::table('colors')
        ->where(['status'=>1])
        ->get();
        //prx($result['colors'][0]->color);
        
        $result['categories_left']=DB::table('categories')->where('status',1)->get();

    
     $result['slug']=$slug;
     $result['sort']=$sort;
     $result['sort_txt']=$sort_txt;
     $result['filter_price_start']=$filter_price_start;
     $result['filter_price_end']=$filter_price_end;
     $result['color_filter']=$color_filter;
     $result['colorFilterArr']=$colorFilterArr;
     
        return view('front.category',$result);
    }
    public function product(Request $request,$slug)
    {
        $result['product']=DB::table('products')
                        ->where(['status'=>1])
                        ->where(['slug'=>$slug])
                        ->get();

        foreach($result['product'] as $list1){        
                $result['product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftjoin('colors','colors.id','=','product_attr.color_id')
                ->where('product_attr.product_id',$list1->id)
                ->get();
        }

        foreach($result['product'] as $list1){        
                $result['product_images'][$list1->id]=
                DB::table('product_images')
                ->where('product_images.product_id',$list1->id)
                ->get();
        }

        $result['related_product']=DB::table('products')
                        ->where(['status'=>1])
                        ->where('slug','!=',$slug)
                        ->where(['category_id'=>$result['product'][0]->category_id])
                        ->get();
        
        foreach($result['related_product'] as $list1){        
                $result['related_product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where('product_attr.product_id',$list1->id)
                ->get();
        }

        $result['product_review']=
                DB::table('product_review')
                ->leftjoin('customers','customers.id','=','product_review.customer_id')
                ->where('product_review.product_id',$result['product'][0]->id)
                ->where('product_review.status',1)
                ->orderBy('product_review.added_on','desc')
                ->select('product_review.rating','product_review.review','product_review.added_on','customers.name')
                ->get();

        return view('front.product',$result);
    }

    public function add_to_cart(Request $request)
    {
        //prx($request);
        if($request->session()->has('FORNT_USER_LOGIN')){
            
            $uid=$request->session()->get('FORNT_USER_ID');
            $user_type="Reg";
        }else{
            //prx($request->session()->get('USER_TEMP_ID'));
           
            $uid=getUserTempId();
            $user_type="Not-Reg";
        }

            
            $size_id=$request->post('size_id');
            $color_id=$request->post('color_id');
            $pqty=$request->post('pqty');
             $product_id=$request->post('product_id');

            if($color_id!='' && $size_id!='' )
            {
                
                //prx($pqty);
                $size=DB::table('sizes')->select('id')->where('size',$size_id)->get();
                //prx($size);
                $size_size=$size[0]->id;
                $color=DB::table('colors')->select('id')->where('color',$color_id)->get();
                $color_color=$color[0]->id;
               
            }
            else
            {
                $size_size=0;
                $color_color=0;
            }
           

            $result1=DB::table('product_attr')
            ->select('id')
            ->where(['product_id'=>$product_id])
            ->where('size_id',$size_size)
            ->where('color_id',$color_color)
            ->get();
          $product_attr_id=$result1[0]->id;
    
         $getAvaliableQty=getAvaliableQty($product_id,$product_attr_id); 
        // prx($getAvaliableQty);
         $finalAvaliable=$getAvaliableQty[0]->pqty-$getAvaliableQty[0]->qty;
         
         if($pqty>$finalAvaliable){
            return response()->json(['msg'=>"not_avaliable",'data'=>"Only $finalAvaliable left"]);     
         }
    
            $check=DB::table('cart')
                ->where(['uid'=>$uid])
                ->where(['user_type'=>$user_type])
                ->where(['product_id'=>$product_id])
                ->where(['product_attr_id'=>$product_attr_id])
                ->get();
            //    prx($check);
            if(isset($check[0])){
                $update_id=$check[0]->id;
                if($pqty==0)
                {
                    DB::table('cart')
                        ->where(['id'=>$update_id])
                        ->delete();
                    $msg="Remove";
                }
                else
                {
                    DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->update(['qty'=>$pqty]);
                    $msg="updated";
                }
               
            }else{
              
                $id=DB::table('cart')->insertGetId([
                    'uid'=>$uid,
                    'user_type'=>$user_type,
                    'product_id'=>$product_id,
                    'product_attr_id'=>$product_attr_id,
                    'qty'=>$pqty,
                    'added_on'=>date('Y-m-d h:i:s')
                ]);
                $msg="added";
            }
            
            $result['list']=DB::table('cart')
            ->leftJoin('products','products.id','=','cart.product_id')
            ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colors','colors.id','=','product_attr.color_id')
            ->where(['uid'=>$uid])
            ->where(['user_type'=>$user_type])
            ->select('cart.qty','products.name','products.slug','products.image','products.id as pid',
            'product_attr.id as attr_id','sizes.size','colors.color','product_attr.price')
            ->get();
            //prx(count($result['list']));
           
            
        return response()->json(['msg'=>$msg,'data'=>$result,'totalItem'=>count($result['list'])]);
    }
 
    public function cart(Request $request)
    {
       
        if($request->session()->has('FORNT_USER_ID')){
            $uid=$request->session()->get('FORNT_USER_ID');
            $user_type="Reg";
          
        }else{
           $uid=getUserTempId();
            $user_type="Not-Reg";
            
        }
        $result['list']=DB::table('cart')
                ->leftJoin('products','products.id','=','cart.product_id')
                ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colors','colors.id','=','product_attr.color_id')
                ->where(['uid'=>$uid])
                ->where(['user_type'=>$user_type])
                ->select('cart.qty','products.name','products.slug','products.image','products.id as pid','product_attr.id as attr_id','sizes.size','colors.color','product_attr.price')
                ->get();
        
        return view('front.cart',$result);
    }
    public function search(Request $request,$str)
    {
        $result['product']=DB::table('products')
            ->where(['status'=>1])
            ->where('name','like',"%$str%")
            ->orwhere('model','like',"%$str%")
            ->orwhere('keywords','like',"%$str%")
            ->orwhere('technical_specification','like',"%$str%")
            ->orwhere('short_desc','like',"%$str%")
            ->orwhere('desc','like',"%$str%")
            ->get();

            $query=DB::table('products');
            $query=$query->leftJoin('categories','categories.id','=','products.category_id');
            $query=$query->leftJoin('product_attr','products.id','=','product_attr.product_id');
            $query=$query->where(['products.status'=>1]);
           
            $query=$query->where('name','like',"%$str%");
            $query=$query->orwhere('model','like',"%$str%");
            $query=$query->orwhere('keywords','like',"%$str%");
            $query=$query->orwhere('technical_specification','like',"%$str%");
            $query=$query->orwhere('short_desc','like',"%$str%");
            $query=$query->orwhere('desc','like',"%$str%");

            $query=$query->distinct()->select('products.*');
            $query=$query->get();
            $result['product']=$query;
            
    
            foreach($result['product'] as $list1){
                $query=DB::table('product_attr');
                $query=$query->leftjoin('sizes','sizes.id','=','product_attr.size_id');
                $query=$query->leftjoin('colors','colors.id','=','product_attr.color_id');
                $query=$query->where('product_attr.product_id',$list1->id);
                $query=$query->get();
                $result['product_attr'][$list1->id]=$query;
            }
       return view('front.search',$result);
    }

    public function registration(Request $request)
    {
        if($request->session()->has('FORNT_USER_LOGIN')!=null){
            return redirect('/');    
        }
      $result=[];
       return view('front.registration',$result);
      
    }
    public function registrashion_process(Request $request){
        $valid=Validator::make($request->all(),[
            "name"=>'required',
            "email"=>'required|email|unique:customers,email',
            "password"=>'required',
            "mobile"=>'required|numeric|digits:10',
           
        ]);

        if(!$valid->passes()){
            return response()->json(['status'=>'error','error'=>$valid->errors()->toArray()]);
        }else{
            $rand_id=rand(111111111,999999999);
            $arr=[
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Crypt::encrypt($request->password),
                "mobile"=>$request->mobile,
                "status"=>1,
                "is_verify"=>0,
                "rand_id"=>$rand_id,
                "created_at"=>date('Y-m-d h:i:s'),
                "updated_at"=>date('Y-m-d h:i:s')
            ];
            $query=DB::table('customers')->insert($arr);
            if($query){
                $data=['name'=>$request->name,'rand_id'=>$rand_id];
                $user['to']=$request->email;
                Mail::send('front/email_varificaton',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Email id Varification ');
                });
                return response()->json(['status'=>'success','msg'=>"Registration Successfully Pleace Check your Email id for Varification"]);
            }
        }
    }

    public function login_process(Request $request){
        
        $result=DB::table('customers')
            ->where(['email'=>$request->str_login_email])
            ->get();
        
        if(isset($result[0])){
            $db_pwd=Crypt::decrypt($result[0]->password);
            if($db_pwd==$request->str_login_password)
            {
                if($request->rememberme===null){
                    setcookie('login_email',$request->str_login_email,100);
                    setcookie('login_pwd',$request->str_login_password,100);
                }else{
                    setcookie('login_email',$request->str_login_email,time()+60*60*24*100);
                    setcookie('login_pwd',$request->str_login_password,time()+60*60*24*100);
                }
                $request->session()->put('FORNT_USER_LOGIN','yes');
                $request->session()->put('FORNT_USER_ID',$result[0]->id);
                $request->session()->put('FORNT_USER_NAME',$result[0]->name);
                $status="success";
                $msg="";

                $getUserTempId=getUserTempId();

                DB::table('cart')
                ->where(['uid'=>$getUserTempId,'user_type'=>'Not-Reg'])
                ->update(['uid'=>$result[0]->id,'user_type'=>'Reg']);
             
            }else{
                $status="error";
                $msg="Place Enter valid Password";
            }   
            
        }else{
            $status="error";
            $msg="Place Enter valid Email id";
        }
        
        return response()->json(['status'=>$status,'msg'=>$msg]);
        //$request->password
        
    }

    public function email_verification(Request $request,$id){
        $result=DB::table('customers')
        ->where(['rand_id'=>$id])
        ->where(['is_verify'=>0])
        ->get();

        if(isset($result[0])){
            DB::table('customers')
            ->where(['id'=>$result[0]->id])
            ->update(['is_verify'=>1,'rand_id'=>'']);
            return view('front.varification');
        }else{
            return redirect('/');
        }
    }   

    public function forgot_password(Request $request){

        $result=DB::table('customers')
            ->where(['email'=>$request->str_forgot_email])
            ->get();
            $rand_id=rand(111111111,999999999);
        if(isset($result[0])){
           
            DB::table('customers')
            ->where(['email'=>$request->str_forgot_email])
            ->update(['is_forgot_password'=>1,'rand_id'=>$rand_id]);


            $data=['name'=>$result[0]->name,'rand_id'=>$rand_id];
            $user['to']=$request->str_forgot_email;
            Mail::send('front/forgot_email',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Forgot Password');
            });
            return response()->json(['status'=>'success','msg'=>'Place Check your Email id for Password']);
        }else{
            return response()->json(['status'=>'error','msg'=>'Email id Not registerd']);
        }
    }

    public function forgot_password_change(Request $request,$id){
        $result=DB::table('customers')
        ->where(['rand_id'=>$id])
        ->where(['is_forgot_password'=>1])
        ->get();

        if(isset($result[0])){
            $request->session()->put('FORGOT_PASSWORD_USER_ID',$result[0]->id);
            return view('front.forgot_password_change');
        }else{
            return redirect('/');
        }
    }   

    public function forgot_password_change_process(Request $request){
        
       DB::table('customers')
        ->where(['id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
        ->update(['is_forgot_password'=>0,'rand_id'=>'','password'=>Crypt::encrypt($request->password)]);
        return response()->json(['status'=>'success','msg'=>'Password is update']);
        
    }   
    public function checkout(Request $request){
        $result['cart_data']=getAddToCartTotalItem();
        
        if(isset($result['cart_data'][0])){

            if($request->session()->has('FORNT_USER_ID')){
                $uid=$request->session()->get('FORNT_USER_ID');
                $customer_info=DB::table('customers')
                ->where(['id'=>$uid])
                ->get();
                //prx($customer_info);
                $result['customer']['name']=$customer_info[0]->name;
                $result['customer']['email']=$customer_info[0]->email;
                $result['customer']['mobile']=$customer_info[0]->mobile;
                $result['customer']['address']=$customer_info[0]->address;
                $result['customer']['city']=$customer_info[0]->city;
                $result['customer']['state']=$customer_info[0]->state;
                $result['customer']['zip']=$customer_info[0]->zip;
            }else{
                $result['customer']['name']="";
                $result['customer']['email']="";
                $result['customer']['mobile']="";
                $result['customer']['address']="";
                $result['customer']['city']="";
                $result['customer']['state']="";
                $result['customer']['zip']="";
            }

           return view('front.checkout',$result);
        }else{
            return redirect('/');
        }
    }
    public function apply_coupon_code(Request $request){
        
        $arr=apply_coupon_code($request->coupon_code);
        $arr=json_decode($arr,true);
        //prx($arr);
        return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg'],'totalprice'=>$arr['totalprice']]);
    }

    public function remove_coupon_code(Request $request){
        
        $result=DB::table('coupons')
            ->where(['code'=>$request->coupon_code])
            ->get();
            $totalprice=0;
            
            $getAddToCartTotalItem=getAddToCartTotalItem();
            $totalprice=0;
            foreach($getAddToCartTotalItem as $list){
                $totalprice=$totalprice+($list->qty*$list->price);
            }
      
    
        return response()->json(['status'=>'success','msg'=>'Coupon Code Remove','totalprice'=>$totalprice]);
        
        
    }
    
    public function place_order(Request $request){
        //prx($_POST);
        $payment_url='';
        $rand_id=rand(111111111,999999999);
        if($request->session()->has('FORNT_USER_LOGIN')){

        }else{
            $valid=Validator::make($request->all(),[
                "email"=>'required|email|unique:customers,email',
            ]);
    
            if(!$valid->passes()){
                return response()->json(['status'=>'error','msg'=>"This Email is Already been taken"]);
            }else{
                
                 $arr=[
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "address"=>$request->address,
                    "city"=>$request->city,
                    "state"=>$request->state,
                    "zip"=>$request->zip,
                    "password"=>Crypt::encrypt($rand_id),
                    "mobile"=>$request->mobile,
                    "status"=>1,
                    "is_verify"=>1,
                    "rand_id"=>$rand_id,
                    "created_at"=>date('Y-m-d h:i:s'),
                    "updated_at"=>date('Y-m-d h:i:s'),
                    "is_forgot_password"=>0,
                ];
               
                $user_id=DB::table('customers')->insertGetId($arr);
                $request->session()->put('FORNT_USER_LOGIN','yes');
                $request->session()->put('FORNT_USER_ID',$user_id);
                $request->session()->put('FORNT_USER_NAME',$request->name);

                $data=['name'=>$request->name,'password'=>$rand_id];
                $user['to']=$request->email;
                Mail::send('front/password_send',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('New Password');
                });
                $getUserTempId=getUserTempId();

                DB::table('cart')
                ->where(['uid'=>$getUserTempId,'user_type'=>'Not-Reg'])
                ->update(['uid'=>$user_id,'user_type'=>'Reg']);

                
            }
        }
            $coupon_value=0;
            if($request->coupon_code!=''){
                $arr=apply_coupon_code($request->coupon_code);
                $arr=json_decode($arr,true);
                if($arr['status']=='success'){
                    $coupon_value=$arr['coupon_code_value'];
                }else{
                    return response()->json(['status'=>'false','msg'=>$arr['msg']]);
                }
            }
            

            $uid=$request->session()->get('FORNT_USER_ID');
            $totalprice=0;
            $getAddToCartTotalItem=getAddToCartTotalItem();       
            foreach($getAddToCartTotalItem as $list){
                $totalprice=$totalprice+($list->qty*$list->price);

            }
            
            $arr=[
                "customers_id"=>$uid,
                "name"=>$request->name,
                "email"=>$request->email,
                "mobile"=>$request->mobile,
                "city"=>$request->city,
                "address"=>$request->address,
                "state"=>$request->state,
                "pincode"=>$request->zip,
                "coupon_code"=>$request->coupon_code,
                "coupon_value"=>$coupon_value,
                "order_status"=>1,
                "payment_status"=>"Pending",
                "payment_type"=>$request->payment_type,
                "total_amt"=>$totalprice,
                "added_on"=>date('Y-m-d h:i:s')
                
            ];
           
            $order_id=DB::table('orders')->insertGetId($arr);
           
            if($order_id>0){
                $productDetailArr=[];
                $totalprice=0;
                foreach($getAddToCartTotalItem as $list){
                    $totalprice=$totalprice+($list->qty*$list->price);
                    
                    $productDetailArr['order_id']=$order_id;
                    $productDetailArr['product_id']=$list->pid;
                    $productDetailArr['product_attr_id']=$list->attr_id;
                    $productDetailArr['price']=$list->price;
                    $productDetailArr['qty']=$list->qty;

                    DB::table('orders_detalis')->insertGetId($productDetailArr);
                }
                
                if($request->payment_type=="Gateway")
                {
                    $final_amt=$totalprice-$coupon_value;
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'api_link');
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,
                                array("API_KEY",
                                    "API_TOKEN"));
                    $payload = Array(
                        'purpose' => 'Buy Product',
                        'amount' => $final_amt,
                        'phone' => $request->mobile,
                        'buyer_name' => $request->name,
                        'redirect_url' => 'http://127.0.0.1:8000/instamojo_payment_redirect',
                        'send_email' => true,
                        'send_sms' => true,
                        'email' => $request->email,
                        'allow_repeated_payments' => false
                    );
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch); 
                    $response=json_decode($response);
                    if(isset($response->payment_request->id)){
                        $txn_id=$response->payment_request->id;
                        DB::table('orders')
                        ->where(['id'=>$order_id])
                        ->update(['txn_id'=>$txn_id]);
                        $payment_url=$response->payment_request->longurl;
                    }else{
                        $msg="";
                        foreach($response->message as $key=>$val){
                            $msg.=$key.":".$val[0].'<br>';
                        }
                        return response()->json(['status'=>'error','msg'=>$msg,'payment_url'=>'']);
                    }
                    
                }
                DB::table('cart')
                    ->where(['uid'=>$uid,'user_type'=>'Reg'])
                    ->delete();

                $request->session()->put('ORDER_ID',$order_id);

                $status="success";
                $msg="Order Placed";
            }else{
                $status="false";
                $msg="Place try after sometime";
            }
            
        /*}else{
            $status="false";
            $msg="Place Login to place Order";
        }*/
       
        return response()->json(['status'=>$status,'msg'=>$msg,'payment_url'=>$payment_url]);
    }
    
    public function order_placed(Request $request){
        
            if($request->session()->has('ORDER_ID')){
                return view('front.order_placed');
            }else{
               return redirect("/");
            }
    }

    public function order_fail(Request $request){
        
        if($request->session()->has('ORDER_ID')){
            return view('front.order_fail');
        }else{
           return redirect("/");
        }
    }

    public function instamojo_payment_redirect(Request $request){
        if($request->get('payment_id')!==null && $request->get('payment_status')!==null && $request->get('payment_request_id')!==null){
            if($request->get('payment_status')=='Credit'){
                $status="Success";
                $redirect_url="/order_placed";
            }else{
                $status="Fail";
                $redirect_url="/order_fail";
            }
            $request->session()->put('ORDER_STATUS',$status);
            DB::table('orders')
                ->where(['txn_id'=>$request->get('payment_request_id')])
                ->update(['payment_status'=>$status,'payment_id'=>$request->get('payment_id')]);
                return redirect($redirect_url);
        }else{
            die('something went wrong');
        }
    }

    public function order(Request $request){
        $result['orders']=DB::table('orders')
        ->select('orders.*','orders_status.orders_status')
        ->leftjoin('orders_status','orders_status.id','=','orders.order_status')
        ->where(['orders.customers_id'=>$request->session()->get('FORNT_USER_ID')])
        ->get();
        //prx($result);
        return view('front.order',$result); 
    }
    
    public function order_detail(Request $request,$id){
       
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
        ->where(['orders.customers_id'=>$request->session()->get('FORNT_USER_ID')])
        ->get();
        //prx($result['orders_detalis']);
        if(!isset($result['orders_detalis'][0])){
            return redirect("/"); 
        }
        return view('front.order_detail',$result); 
    }
    function product_review_process(Request $request){
        if($request->session()->has('FORNT_USER_LOGIN')){
            $uid=$request->session()->get('FORNT_USER_ID');
            $arr=[
                "customer_id"=>$uid,
                "product_id"=>$request->product_id,
                "rating"=>$request->rating,
                "review"=>$request->review,
                "status"=>1,
                "added_on"=>date('Y-m-d h:i:s')
            ];
            $query=DB::table('product_review')->insert($arr);
            $status="success";
            $msg="Thank You For Providing Your review";
        }else{
            $status="error";
            $msg="Please Login to submit your review ";
        }       
        return response()->json(['status'=>$status,'msg'=>$msg]);
    }
}
