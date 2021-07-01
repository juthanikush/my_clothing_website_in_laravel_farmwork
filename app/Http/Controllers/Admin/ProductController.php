<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['data']=Product::all();
        return view('admin.product',$result);
    }

    
    public function manage_product(Request $request ,$id=' ')
    {

        
        if($id>0){
           /* $model=Category::find($id);
            $result['data']=$model;
            return view('admin.manage_category',$result);*/
            $arr=Product::where(['id'=>$id])->get();
            
            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['slug']=$arr['0']->slug;
            $result['image']=$arr['0']->image;
            $result['brand']=$arr['0']->brand;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;
            $result['lead_time']=$arr['0']->lead_time;
            $result['tax_id']=$arr['0']->tax_id;
      
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;

            $result['productAttrArr']=DB::table('product_attr')->where(['product_id'=>$id])->get();

            $productImagesArr=DB::table('product_images')->where(['product_id'=>$id])->get();

            if(!isset($productImagesArr[0])){
                $result['productImagesArr']['0']['id']='';
                $result['productImagesArr']['0']['images']='';
            }else{
                $result['productImagesArr']=$productImagesArr;
            }


        }else{
            $result['category_id']="";
            $result['name']="";
            $result['slug']="";
            $result['image']="";
            $result['brand']="";
            $result['model']="";
            $result['short_desc']="";
            $result['desc']="";
            $result['keywords']="";
            $result['technical_specification']="";
            $result['uses']="";
            $result['warranty']="";
            $result['lead_time']="";
            $result['tax_id']="";
    
            $result['is_promo']="";
            $result['is_featured']="";
            $result['is_discounted']="";
            $result['is_tranding']="";
            $result['status']="";
            $result['id']=0;

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['product_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['image_attr']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';

            $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['images']='';

        }

        $result['category']=DB::table('categories')->where(['status'=>1])->get();

        $result['sizes']=DB::table('sizes')->where(['status'=>1])->get();

        $result['colors']=DB::table('colors')->where(['status'=>1])->get();

        $result['taxs']=DB::table('taxs')->where(['status'=>1])->get();

        $result['brands']=DB::table('brands')->where(['status'=>1])->get();

        return view('admin.manage_product',$result);
    }

    public function manage_product_process(Request $request)
    {//return $request->post();

        if($request->post('id')>0){
            $image_validation="mimes:jpeg,png,jpg";
        }else{
            $image_validation="required|mimes:jpeg,png,jpg";
        }

       $request->validate([
            'name'=>'required',
            'image'=> $image_validation,
            'slug'=>'required|unique:products,slug,'.$request->post('id'),
            'image_attr.*'=>'mimes:jpg,jpeg,png',
            'images.*'=>'mimes:jpg,jpeg,png'
        ]);

        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qtyArr=$request->post('qty');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');
        
        foreach($skuArr as $key=>$val){
            $check=DB::table('product_attr')->
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->
            get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key].'  SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if($request->post('id')>0){
            $model =Product::find($request->post('id'));
            $msg="Product Update";
        }else{
            $model = new Product();
            $msg="Product Inserted";
        }

        if($request->hasfile('image')){
            if($request->post('id')>0){
                $arrImage=DB::table('products')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image) ){
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }
            

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }
       

        
        $model->category_id=$request->post('category_id');
        $model->name=$request->post('name');
        $model->slug=$request->post('slug');
        
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
       
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');

        $model->lead_time=$request->post('lead_time');
        $model->tax_id=$request->post('tax_id');
        
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');

        $model->status=1;
        
        $model->save();
        $pid=$model->id;

        /*Product attr Start*/
        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qtyArr=$request->post('qty');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');
        
        foreach($skuArr as $key=>$val){
            $producyAttrArr=[];
            $producyAttrArr['product_id']=$pid;
            $producyAttrArr['sku']=$skuArr[$key];
            $producyAttrArr['mrp']=(int)$mrpArr[$key];
            $producyAttrArr['price']=(int)$priceArr[$key];
            $producyAttrArr['qty']=(int)$qtyArr[$key];
            if($size_idArr[$key]==''){
                $producyAttrArr['size_id']=0;
            }else{
                $producyAttrArr['size_id']=$size_idArr[$key];
            }
            if($color_idArr[$key]==''){
                $producyAttrArr['color_id']=0;
            }else{
                $producyAttrArr['color_id']=$color_idArr[$key];
            }

            // $producyAttrArr['image_attr']='test';
            if($request->hasFile("attr_image.$key")){

                if($paidArr[$key]!=''){
                    $arrImage=DB::table('product_attr')->where(['id'=>$paidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->image_attr) ){
                        Storage::delete('/public/media/'.$arrImage[0]->image_attr);
                    }
                }
                $rand=rand('111111111','999999999');
                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                $producyAttrArr['image_attr']=$image_name;
            }else{
                //$producyAttrArr['image_attr']='';
            }

            if($paidArr[$key]!=''){
                DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($producyAttrArr);
            }else{
                DB::table('product_attr')->insert($producyAttrArr);
            }
        }
        /*Product attr End*/

         /*Product Image End*/
         $piidArr=$request->post('piid');
         foreach($piidArr as $key=>$val){
            $producyImagesArr['product_id']=$pid;
            if($request->hasFile("images.$key")){

                if($piidArr[$key]!=''){
                    $arrImage=DB::table('product_images')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->images) ){
                        Storage::delete('/public/media/'.$arrImage[0]->images);
                    }
                }

                $rand=rand('111111111','999999999');
                $images=$request->file("images.$key");
                $ext=$images->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("images.$key")->storeAs('/public/media',$image_name);
                $producyImagesArr['images']=$image_name;

                if($piidArr[$key]!=''){
                    DB::table('product_images')->where(['id'=>$piidArr[$key]])->update($producyImagesArr);
                }else{
                    DB::table('product_images')->insert($producyImagesArr);
                }
            }else{
                $producyAttrArr['images']='';
            }





            
         }
         /*Product Image End*/
        $request->session()->flash('message',$msg);
        return redirect('admin/product');
    }

    public function delete(Request $request,$id)
    {
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','Product Delete');
        return redirect('admin/product');
    }

    public function  product_attr_delete(Request $request,$paid,$pid)
    {
        $arrImage=DB::table('product_attr')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->image_attr) ){
            Storage::delete('/public/media/'.$arrImage[0]->image_attr);
        }
       DB::table('product_attr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function  product_images_delete(Request $request,$paid,$pid)
    {
        $arrImage=DB::table('product_images')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images) ){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
        
       DB::table('product_images')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    
    public function status(Request $request,$status ,$id)
    {
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product Status Update');
        return redirect('admin/product');
    }
}
