@extends('front/layout')
@section('page_title','Order Detail')
@section('container')
<section id="aa-catg-head-banner">
  
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
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
            if($orders_detalis[0]->track_details!=''){
              echo 'Track Details  '. $orders_detalis[0]->track_details;
            }
            ?>
            
          </div>
        </div>
       <div class="col-md-12">
         <div class="cart-view-area">
         
           <div class="cart-view-table">
             <form action="">
            
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
                            <td><img src="{{asset('storage/media/'.$list->image_attr)}}"></td>
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
               
             </form>
             <!-- Cart Total view 
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>$450</td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>$450</td>
                   </tr>
                 </tbody>
               </table>
               <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
             -->
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 
@endsection