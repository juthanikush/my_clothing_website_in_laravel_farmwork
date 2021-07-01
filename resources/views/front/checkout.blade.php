@extends('front/layout')
@section('page_title','Checkout')
@section('container')
<section id="checkout">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form id="frmPlaceOrder">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    @if(session()->has('FORNT_USER_LOGIN')==null)
                    <a href="javascript:void(0)" class="aa-browse-btn" data-toggle="modal" data-target="#login-modal">Login</a>
 						<br><br>OR<br><br>
                    @endif
                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title" style="color:red;">
                          Shippping Address
                        </h4>
                      </div>
                      <div id="collapseFour" >
                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Name*" name="name" required value="{{$customer['name']}}">
                              </div>                             
                            </div>
                           
                          
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="email" placeholder="Email Address*" name="email" required value="{{$customer['email']}}">
                              </div>                             
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="tel" placeholder="Phone*" name="mobile" required value="{{$customer['mobile']}}">
                              </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="8" rows="3" placeholder="address*" name="address" required>{{$customer['address']}}</textarea>
                              </div>                             
                            </div>                            
                          </div>   
                      
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="City / Town*" name="city" required value="{{$customer['city']}}">
                              </div>                             
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="District*" name="state" required value="{{$customer['state']}}">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="ZIP/Postcode*" name="zip" required value="{{$customer['zip']}}">
                              </div>
                            </div>
                          </div>   
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php
                        $total=0;
                      @endphp
                      @foreach($cart_data as $list)
                        <tr>
                          <td>{{$list->name}} <strong> x  {{$list->qty}}</strong>
                          <br>
                          <span class="cart_color">{{$list->color}}</span></td>
                          <td>INR {{$list->price*$list->qty}}</td>
                        </tr>
                        @php
                            $total=$total+($list->price*$list->qty);
                        @endphp
                    @endforeach
                      </tbody>
                      <tfoot>
                        <tr class="hide show_coupon_box">
                          <th>Coupon code <a href="javascript:void(0)" onclick="remove_coupon_code()" class="remove_coupon_code_link">Remove</a></th>
                          <td id="Coupon_code_str"></td>
                        </tr>
                        
                         <tr>
                          <th>Total</th>
                          <td id="total_price">INR {{$total}}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Coupon Code</h4>
                  <div class="aa-payment-method">                    
                      <div class="panel-body">
                          <input type="text" style="width: 100%;" placeholder="Coupon Code" name="coupon_code" id="coupon_code" class="coupon_code apply_coupon_code_box input">
                          <input type="button" value="Apply Coupon" style="width: 100%;" class="space aa-browse-btn apply_coupon_code_box" onclick="applyCouponcode()">
                          <div id="coupon_code_msg"></div>
                        </div>     
                  </div>
<br>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                     
                    <label for="cod"><input type="radio" id="cod" value="cod" name="payment_type" checked> Cash on Delivery </label>
                    <label for="Instamojo"><input type="radio" value="Gateway" id="Instamojo" name="payment_type" > Instamojo </label>
                    
                    <input type="submit" value="Place Order" id="btnPlaceOrder" class="aa-browse-btn">
                                  
                  </div>
                  <div id="order_place_msg"></div>  
                </div>
              </div>
            </div>
            @csrf
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
 @php
      if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pwd'])){
        $login_email=$_COOKIE['login_email'];
        $login_pwd=$_COOKIE['login_pwd'];
        $is_remember="checked='checked'";
      }else{
        $login_email='';
        $login_pwd="";
        $is_remember="";
      }
  @endphp
  <!-- Login Modal -->  
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <div id="popup_login">
              <h4>Login or Register</h4>
              <form class="aa-login-form" id="frmLogin">
              @csrf
                <label for="">Email address<span>*</span></label>
                <input type="email" required placeholder="Email" name="str_login_email" value="{{$login_email}}"> 
                <label for="">Password<span>*</span></label>
                <input type="password" placeholder="Password" name="str_login_password" required value="{{$login_pwd}}">
                <button class="aa-browse-btn" type="submit" id="btnLogin">Login</button>
                <label for="rememberme" class="rememberme"><input type="checkbox" {{$is_remember}} name="rememberme" id="rememberme"> Remember me </label>
                <div id="login_msg"></div>
                <p class="aa-lost-password"><a href="javascript:void(0)" onclick="forgot_password()">Lost your password?</a></p>
                
                <div class="aa-register-now">
                  Don't have an account?<a href="{{url('registration')}}">Register now!</a>
                </div>
                
              </form>
          </div>
          <div id="popup_forgot" style="display:none;">
              <h4>Forgot Password</h4>
              <form class="aa-login-form" id="frmForgot">
              @csrf
                <label for="">Email address<span>*</span></label>
                <input type="email" required placeholder="Email" name="str_forgot_email" > 
                <button class="aa-browse-btn" type="submit" id="btnForgot">Submit</button>
                <br><br><br><br>
                <div id="forget_msg"></div>
                
                <div class="aa-register-now">
                  Login form ?<a href="javascript:void(0)" onclick="show_login_popup()">Login now!</a>
                </div>
              </form>
          </div>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>    
 @endsection