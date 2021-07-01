@extends('front/layout')
@section('page_title','Registration')
@section('container')
<!-- catg header banner section -->
<section id="aa-catg-head-banner">
   
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="" class="aa-login-form" id="frmRegistrashion">
                    <label for="">Name<span>*</span></label>
                    <input type="text" name="name" placeholder="Name" required>
                    <span id="name_error" class="field_error"></span><br>

                    <label for="">Email<span>*</span></label>
                    <input type="email" name="email" placeholder="Email" required>
                    <span id="email_error" class="field_error"></span><br>

                    <label for="">Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="password" required>
                    <span id="password_error" class="field_error"></span><br>

                    <label for="">Mobile<span>*</span></label>
                    <input type="text" name="mobile" placeholder="Mobile No." required>
                    <span id="mobile_error" class="field_error"></span><br>

                    <button type="submit" class="aa-browse-btn" id="btnRegistrashion">Register</button>                    
                    @csrf
                  </form>
                </div>
                <div id="thank_you_msg" class="field_error"></div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
@endsection