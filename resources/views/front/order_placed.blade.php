@extends('front/layout')
@section('page_title','Order Placed')
@section('container')

<section id="aa-product-category">
    <div class="container">
      <div class="row">
       <br><br>
        <h2>Your Order is Placed</h2>
        <h2>Order Id:-{{session()->get('ORDER_ID')}}</h2>
       <br><br>
       
      </div>
    </div>
  </section>

  
@endsection