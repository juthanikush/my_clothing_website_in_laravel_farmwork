@extends('admin/layout')
@section('page_title','Manage Product')
@section('product_select','active')
@section('container')

@if($id>0)
    {{$image_required=""}}
@else
    {{$image_required="required"}}
@endif


<h1>Manage Product</h1><Br>

@if(session()->has('sku_error'))
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{session('sku_error')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
</button>
</div>
@endif

@error('attr_image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{$message}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
</button>
</div>
@enderror

@error('images.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{$message}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
</button>
</div>
@enderror
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<a href="{{url('admin/product')}}">
    <button type="button" class="btn btn-success">Back</button>
</a>


<div class="row m-t-30">
   <div class="col-md-12">
   <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        
                        
                            @csrf
                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Name</label>
                                <input id="name" name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Image</label>
                                <input id="image" name="image" type="file"  class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                                @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                    
                                @enderror
                                @if($image!='')
                                        <a href="{{asset('storage/media/'.$image)}}" traget="_blank"><img src="{{asset('storage/media/'.$image)}}" height="150px" width="150px"></a>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label mb-1">Slug</label>
                                <input id="slug" name="slug" type="text" value="{{$slug}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('slug')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                    
                                @enderror
                            </div>
                            <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="category_id" class="control-label mb-1"> Category</label>
                              <select id="category_id" name="category_id" class="form-control" required>
                                 <option value="">Select Categories</option>
                                 @foreach($category as $list)
                                 @if($category_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="brand" class="control-label mb-1"> Brand</label>
                              <select id="brand" name="brand" class="form-control" required>
                                 <option value="">Select Brand</option>
                                 @foreach($brands as $list)
                                 @if($brand==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="model" class="control-label mb-1"> Model</label>
                              <input id="model" value="{{$model}}" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                        </div>
                        
                     </div>
                            <div class="form-group">
                                <label for="short_desc" class="control-label mb-1">short_desc</label>
                                <textarea id="short_desc" name="short_desc" type="text"  class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>
                               
                            </div>
                            <div class="form-group">
                                <label for="desc" class="control-label mb-1">desc</label>
                                <textarea id="desc" name="desc" type="text"  class="form-control" aria-required="true" aria-invalid="false" required>{{$desc}}</textarea>
                                
                            </div>
                            <div class="form-group">
                                <label for="keywords" class="control-label mb-1">keywords</label>
                                <input id="keywords" name="keywords" type="text" value="{{$keywords}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="technical_specification" class="control-label mb-1">technical specification</label>
                                <textarea id="technical_specification" name="technical_specification" type="text"  class="form-control" aria-required="true" aria-invalid="false" required>{{$technical_specification}}</textarea>
                                
                            </div>
                            <div class="form-group">
                                <label for="uses" class="control-label mb-1">uses</label>
                                <input id="uses" name="uses" type="text" value="{{$uses}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="warranty" class="control-label mb-1">warranty</label>
                                <input id="warranty" name="warranty" type="text" value="{{$warranty}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                
                            </div>

                    <div class="form-group">
                        <div class="row">
                           <div class="col-md-4">
                                <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                <input id="lead_time" name="lead_time" type="text" value="{{$lead_time}}" class="form-control" aria-required="true" aria-invalid="false" >
                           </div>
                           <div class="col-md-4">
                                <label for="tax_id" class="control-label mb-1">Tax ID</label>
                                <select id="tax_id" name="tax_id" class="form-control" required>
                                 <option value="">Select Tax</option>
                                 @foreach($taxs as $list)
                                 @if($tax_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->tax_desc}}
                                 </option>
                                 @endforeach
                              </select>
                               
                           </div>
                           
                        </div>
                    </div>       

                    <div class="form-group">
                        <div class="row">
                           <div class="col-md-3">
                                <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                <select id="is_promo" name="is_promo" class="form-control" required>
                                    @if($is_promo=='1')
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>                             
                                    @else
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                    @endif
                                 </select>
                           </div>
                           <div class="col-md-3">
                                <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                <select id="is_featured" name="is_featured" class="form-control" required>
                                    @if($is_featured=='1')
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>                             
                                    @else
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                    @endif
                                 </select>
                           </div>
                           <div class="col-md-3">
                                <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                <select id="is_discounted" name="is_discounted" class="form-control" required>
                                    @if($is_discounted=='1')
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>                             
                                    @else
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                    @endif
                                 </select>
                           </div>
                           <div class="col-md-3">
                                <label for="is_tranding" class="control-label mb-1">Is Tranding</label>
                                <select id="is_tranding" name="is_tranding" class="form-control" required>
                                    @if($is_tranding=='1')
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>                             
                                    @else
                                    <option value="1">Yes</option>
                                    <option value="0" selected>No</option>
                                    @endif
                                 </select>
                           </div>
                        </div>
                    </div>      
                            <input type="hidden" name="id" value={{$id}} />
                        
                    </div>
                </div>
            </div>
	    </div>
        <h2>Product Images</h2><br>
        <div class="col-lg-12" >
           
            <div class="card" >
            @php
                $loop_count_num=1;
                
            @endphp
            @foreach($productImagesArr as $key=>$val)
           
            @php
            $loop_count_prve=$loop_count_num;
                $pIArr=(array)$val;
            @endphp
            <input type="hidden" value="{{$pIArr['id']}}" id="piid" name="piid[]" >
                <div class="card-body">
                <div class="form-group">
                        <div class="row" id="product_images_box">
                           <div class="col-md-4 product_images_{{$loop_count_num++}}" >
                            <div class="form-group">
                                    <label for="images" class="control-label mb-1">Image</label>
                                    <input id="images" name="images[]" type="file"  class="form-control" aria-required="true" aria-invalid="false" >
                                    @if($pIArr['images']!='')
                                        <a href="{{asset('storage/media/'.$pIArr['images'])}}" traget="_blank"><img src="{{asset('storage/media/'.$pIArr['images'])}}" height="150px" width="150px"></a>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                            @if($loop_count_num==2)
                            <label for="images" class="control-label mb-1"></label><br>
                            <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()"><i class="fa fa-plus"></i>&nbsp; ADD</button>
                            @else
                            <label for="image_attr" class="control-label mb-1"></label><br>
                            <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg"  ><i class="fa fa-minus"></i>&nbsp; remove</button></a>
                            @endif
                           </div>
                        </div>
                     </div>
                </div>
                @endforeach
            </div>
            
        </div>
        <h2>Product Attributes</h2><br>
        <div class="col-lg-12" id="product_attr_box">
            @php
                $loop_count_num=1;
                
            @endphp
            @foreach($productAttrArr as $key=>$val)
           
            @php
            $loop_count_prve=$loop_count_num;
                $pAArr=(array)$val;
            @endphp
            <input type="hidden" value="{{$pAArr['id']}}" id=paid name="paid[]" >
            <div class="card" id="product_attr_{{$loop_count_num++}}">
                
                <div class="card-body">
                <div class="form-group">
                        <div class="row">
                           
                           <div class="col-md-2">
                              <label for="sku" class="control-label mb-1"> SKU</label>
                              <input id="sku"  name="sku[]" value="{{$pAArr['sku']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-2">
                              <label for="mrp" class="control-label mb-1"> MRP</label>
                              <input id="mrp"  name="mrp[]" type="text" value="{{$pAArr['mrp']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-2">
                              <label for="price" class="control-label mb-1"> Price</label>
                              <input id="price"  name="price[]" type="text" value="{{$pAArr['price']}}" class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                           <div class="col-md-3">
                              <label for="size_id" class="control-label mb-1"> size_id</label>
                              <select id="size_id" name="size_id[]" class="form-control" >
                                 <option value="">Select Categories</option>
                                 @foreach($sizes as $list)
                                    @if($pAArr['size_id']==$list->id)
                                        <option selected value="{{$list->id}}">
                                    @else
                                        <option value="{{$list->id}}">
                                    @endif
                                 
                                    {{$list->size}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-3">
                              <label for="color_id" class="control-label mb-1"> color_id</label>
                              <select id="color_id" name="color_id[]" class="form-control" >
                                 <option value="">Select color</option>
                                 @foreach($colors as $list)
                                    @if($pAArr['color_id']==$list->id)
                                        <option selected value="{{$list->id}}">
                                    @else
                                        <option value="{{$list->id}}">
                                    @endif
                                                       
                                    {{$list->color}}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-md-2">
                              <label for="qty" class="control-label mb-1"> Qty</label>
                              <input id="qty"  name="qty[]" type="text"  value="{{$pAArr['qty']}}" class="form-control" aria-required="true" aria-invalid="false" >
                           </div>
                           <div class="col-md-6">
                            <div class="form-group">
                                    <label for="image_attr" class="control-label mb-1">Image</label>
                                    <input id="image_attr" name="attr_image[]" type="file"  class="form-control" aria-required="true" aria-invalid="false" >
                                    @if($pAArr['image_attr']!='')
                                        <a href="{{asset('storage/media/'.$pAArr['image_attr'])}}" target="_blank"><img src="{{asset('storage/media/'.$pAArr['image_attr'])}}" height="150px" width="150px"></a>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                            @if($loop_count_num==2)
                            <label for="image_attr" class="control-label mb-1"></label><br>
                            <button type="button" class="btn btn-success btn-lg" onclick="add_more()"><i class="fa fa-plus"></i>&nbsp; ADD</button>
                            @else
                            <label for="image_attr" class="control-label mb-1"></label><br>
                            <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg" ><i class="fa fa-minus"></i>&nbsp; remove</button></a>
                            @endif
                           </div>
                        </div>
                     </div>
                </div>
               
            </div>
            @endforeach
        </div>
        <div>
        
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                submit
            </button>
        </div>
    </form>
   </div>
</div>                        
                            

<script>
var loop_count=1;
function add_more(){
    loop_count++;
    var html='<div id="product_attr'+loop_count+'" class="card"><div class="card-body"><div class="form-group"><div class="row">';

    html+=' <input type="hidden"  id=paid name="paid[]" ><div class="col-md-2"><label for="sku" class="control-label mb-1"> SKU</label><input id="sku"  name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
    html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1"> MRP</label><input id="mrp"  name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
    html+=' <div class="col-md-2"><label for="price" class="control-label mb-1"> Price</label><input id="price"  name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
    html+='<div class="col-md-3"><label for="size_id" class="control-label mb-1"> size_id</label><select id="size_id" name="size_id[]" class="form-control" ><option value="">Select Categories</option>@foreach($sizes as $list)<option value="{{$list->id}}">{{$list->size}}</option>@endforeach</select></div>';
    html+=' <div class="col-md-3"><label for="color_id" class="control-label mb-1"> color_id</label><select id="color_id" name="color_id[]" class="form-control" ><option value="">Select color</option>@foreach($colors as $list)<option value="{{$list->id}}">{{$list->color}}</option>@endforeach</select></div>';
    html+='<div class="col-md-2"><label for="qty" class="control-label mb-1"> Qty</label><input id="qty"  name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
    html+='<div class="col-md-6"><div class="form-group"><label for="image_attr" class="control-label mb-1">Image</label><input id="image_attr" name="attr_image[]" type="file"  class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}></div></div>';
    html+='<div class="col-md-2"><label for="image_attr" class="control-label mb-1"></label><br><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';

    html+='</div></div></div></div>';

    jQuery('#product_attr_box').append(html);
    
}
function remove_more(loop_count){
    jQuery('#product_attr'+loop_count).remove();
}
var loop_image_count=1;


function add_image_more(){
    loop_image_count++;
    var html='<input type="hidden" value="" id="piid" name="piid[]" ><div class="col-md-4 product_images_'+loop_image_count+'" ><div class="form-group"><label for="images" class="control-label mb-1">Image</label><input id="images" name="images[]" type="file"  class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}></div></div>';
    //product_images_box
    html+='<div class="col-md-2  product_images_'+loop_image_count+'"><label for="image_attr" class="control-label mb-1"></label><br><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Remove</button></div>';
    jQuery('#product_images_box ').append(html);

}
function remove_image_more(loop_image_count){
    jQuery('.product_images_'+loop_image_count).remove();
}

	CKEDITOR.replace('short_desc');
    CKEDITOR.replace('desc');
    CKEDITOR.replace('technical_specification');

</script>
@endsection