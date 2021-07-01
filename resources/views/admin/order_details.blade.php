@extends('admin/layout')
@section('page_title','Order Detail')
@section('order_select','active')
@section('container')

@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
{{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>
@endif
<h1>Order - {{$orders_detalis[0]->id}} </h1><Br>

<div class="order_operation">
      <b>Update Order Status</b>
      <select class="form-control m-b-10" id="order_status" onchange="update_order_status('{{$orders_detalis[0]->id}}')">
      <?php
         foreach($order_status as $list){
            if($orders_detalis[0]->orders_status == $list->orders_status){
               echo"<option value='$list->id' selected >$list->orders_status</option>";
            }else{
               echo"<option value='$list->id'>$list->orders_status</option>";
            }
         }
      ?>
         
      </select>

      <b>Update Payment Status</b>
      <select class="form-control m-b-10" id="payment_status" onchange="update_payment_status('{{$orders_detalis[0]->id}}')">
         <?php
         
         foreach($payment_status as $list){
            if($orders_detalis[0]->payment_status == $list){
               echo"<option value='$list' selected >$list</option>";
            }else{
               echo"<option value='$list'>$list</option>";
            }
         }
         ?>
         </select>
         <b>Track Details</b>
         <form method="post">
         @csrf
            <textarea name="track_details" class="form-control" required>{{$orders_detalis[0]->track_details}}</textarea><br>
            <button type="submit" class="btn btn-success">Update</button>
         </form>
         
   </div>


<div class="row m-t-30 whitebg">
<div class="col-md-6">
          <div class="order_detail">
            <h3>Details Address</h3>
            {{$orders_detalis[0]->name}}({{$orders_detalis[0]->mobile}})<br>{{$orders_detalis[0]->email}}<br>{{$orders_detalis[0]->address}}<br>{{$orders_detalis[0]->state}}<br>{{$orders_detalis[0]->pincode}}
          </div>
        </div>
        <div class="col-md-6">
        <div class="order_detail">
            <h3>Order Details</h3>
            Order Status {{$orders_detalis[0]->orders_status}}<br>
            Payment Status {{$orders_detalis[0]->payment_status}}<br>
            Payment Type {{$orders_detalis[0]->payment_type}}<br>
            <?php
            if($orders_detalis[0]->payment_id!=''){
              echo 'Payment Id'. $orders_detalis[0]->payment_id;
            }
            ?>
            
          </div>
        </div>
       <div class="col-md-12">
         <div class="cart-view-area">
         
           <div class="cart-view-table">
            
               <div class="table-responsive">
              
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Imageg</th>
                        <th>size</th>
                        <th>color</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalAmt=0;
                    @endphp
                      @foreach($orders_detalis as $list)
                    @php
                        $totalAmt=$totalAmt+($list->price*$list->qty);
                    @endphp
                        <tr>
                            <td>{{$list->pname}}</td>
                            <td><img src="{{asset('storage/media/'.$list->image_attr)}}" height="250px" width="250px"></td>
                            <td>{{$list->size}}</td>
                            <td>{{$list->color}}</td>
                            <td>{{$list->price}}</td>
                            <td>{{$list->qty}}</td>
                            <td>{{$list->price*$list->qty}}</td>
                        </tr>
                      @endforeach
                      <tr>
                            <td colspan="5">&nbsp;</td>
                            <td>Total</td>
                            <td>{{$totalAmt}}</td>
                        </tr>
                      <?php
                      if($orders_detalis[0]->coupon_value>0)
                      echo'<tr><td colspan="5">&nbsp;</td><td>Coupon</td><td>'.$orders_detalis[0]->coupon_value.'</td></tr>';
                        $totalAmt=$totalAmt-$orders_detalis[0]->coupon_value;
                      echo'<tr><td colspan="5">&nbsp;</td><td>Final Total</td><td>'.$totalAmt.'</td></tr>';
                      ?>
                    </tbody>
                  </table>
                </div>   
            </div>
         </div>
       </div>
   </div>                       
@endsection