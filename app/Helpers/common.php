<?php
use Illuminate\Support\Facades\DB;
function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}
function getTopNavCat(){
   $result=DB::table('categories')->where('status',1)->get();
   $arr=[];
    foreach($result as $row){
        $arr[$row->id]['category_name']=$row->category_name;
        $arr[$row->id]['parent_id']=$row->parent_categories_id;
        $arr[$row->id]['category_slug']=$row->category_slug;
    }
    $str=buildTreeView($arr,0);
    return $str;
}


$html="";
function buildTreeView($arr,$parent,$level = 0,$prelevel = -1){
    global $html;
    foreach($arr as $id=>$data){
        if($parent==$data['parent_id']){
            if($level>$prelevel){
                if($html==""){
                    $html.='<ul class="nav navbar-nav">';
                }else{
                    $html.='<ul class="dropdown-menu">';
                }
               
            }
            if($level==$prelevel){
                $html.='</li>';
            }
            $url=url("category/".$data['category_slug']);
            $html.='<li><a href="'.$url.'" >'.$data['category_name'].'<span class="caret"></span></a>';
            if($level>$prelevel){
                $prelevel=$level;
            }
            $level++;
            buildTreeView($arr,$id,$level,$prelevel);
            $level--;
        }
    }
    if($level==$prelevel){
        $html.='</li></ul>';
    }
    return $html;
}
function getUserTempId(){
  
   if(session()->has('USER_TEMP_ID')==null)
   {
        $rand=rand(111111111,999999999);
        session()->put('USER_TEMP_ID',$rand);
        return $rand;
   }else{
        return session()->get('USER_TEMP_ID');
    }
}
function getAddToCartTotalItem(){
    if(session()->has('FORNT_USER_LOGIN')){
        $uid=session()->get('FORNT_USER_ID');
        $user_type="Reg";
    }else{
        $uid=getUserTempId();
        $user_type="Not-Reg";
    }
    $result=DB::table('cart')
    ->leftJoin('products','products.id','=','cart.product_id')
    ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
    ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
    ->leftJoin('colors','colors.id','=','product_attr.color_id')
    ->where(['uid'=>$uid])
    ->where(['user_type'=>$user_type])
    ->select('cart.qty','products.name','products.slug','products.image','products.id as pid','product_attr.id as attr_id','sizes.size','colors.color','product_attr.price')
    ->get();
    return $result;
    
 }

 function apply_coupon_code($coupon_code){
    $result=DB::table('coupons')
    ->where(['code'=>$coupon_code])
    ->get();
    $totalprice=0;
if(isset($result[0])){
    $value=$result[0]->value;
    $type=$result[0]->type;
    if($result[0]->status==1){
        if($result[0]->is_one_time==1){
            $status="error";
            $msg="Coupon Code already used";
        }else{
            $min_order_amt=$result[0]->min_order_amt;
            if($min_order_amt>0){
                $getAddToCartTotalItem=getAddToCartTotalItem();
                $totalprice=0;
                foreach($getAddToCartTotalItem as $list){
                    $totalprice=$totalprice+($list->qty*$list->price);
                }
                if($min_order_amt<$totalprice){
                    $status="success";
                    $msg="Coupon Code applied";
                }else{
                    $status="error";
                    $msg="Cart amount must be grater then $min_order_amt";
                }
            }else{
                $status="success";
                $msg="Coupon Code applied";
            }
            
        }
       
    }else{
        $status="error";
        $msg="Coupon Code deactivted";
    }
   
}else{
    $status="error";
    $msg="Place enter Valide Coupon Code";
}
$coupon_code_value=0;
if($status=='success')
{
    if($type=='Value'){
        $coupon_code_value=$value;
        $totalprice=$totalprice-$value;
    }
    if($type=='Per'){
        $newPrice=($value/100)*$totalprice;
        $totalprice=round($totalprice-$newPrice);
        $coupon_code_value=$newPrice;

    }
}
return json_encode(['status'=>$status,'msg'=>$msg,'totalprice'=>$totalprice,'coupon_code_value'=>$coupon_code_value]);
 }

function getCustomDate($date){
    if($date!=''){
        $date=strtotime($date);
        return date('d-M Y',$date);
    }
}

function getAvaliableQty($product_id,$attr_id){
    $result=DB::table('orders_detalis')
    ->leftJoin('orders','orders.id','=','orders_detalis.order_id')
    ->leftJoin('product_attr','product_attr.id','=','orders_detalis.product_attr_id')
    ->where(['orders_detalis.product_id'=>$product_id])
    //->where(['product_attr.id'=>$attr_id])
    ->where(['orders_detalis.product_attr_id'=>$attr_id])
    ->select('orders_detalis.qty','product_attr.qty as pqty')
    ->get();
   // $result=DB::table('product_attr')->where('id',$attr_id)->select('qty as pqty')->get();
    return $result;     
}
?>