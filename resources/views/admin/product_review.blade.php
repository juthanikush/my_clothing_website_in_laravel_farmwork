@extends('admin/layout')
@section('page_title','Product Review')
@section('product_review_select','active')
@section('container')



@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
{{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>
@endif
<h1>Product Review</h1><Br>


<div class="row m-t-30">
   <div class="col-md-12">
      <!-- DATA TABLE-->
      <div class="table-responsive m-b-40">
         <table class="table table-borderless table-data3">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Customer Name</th>
                  <th>Product Name</th>
                  <th>Review</th>
                  <th>Rating</th>
                  <th>Date</th>
                  <th>Action</th>
                  
               </tr>
            </thead>
            <tbody>
            @foreach($product_review as $list)
               <tr>
                  <td>{{$list->id}}</td>
                  <td>{{$list->name}}</td>
                  <td>{{$list->pname}}</td>
                  <td>{{$list->rating}}</td>
                  <td>{{$list->review}}</td>
                  <td>{{$list->added_on}}</td>
                  <td>
                    
                     @if($list->status==1)
                     <a href="{{url('admin/update_product_review_status/0')}}/{{$list->id}}"><button class="btn btn-warning">Active</button></a>
                     @elseif($list->status==0)
                     <a href="{{url('admin/update_product_review_status/1')}}/{{$list->id}}"><button class="btn btn-secondary">Deactive</button></a>
                     @endif
                     
                  </td>
               </tr>
            @endforeach
            </tbody>
         </table>
      </div>
      <!-- END DATA TABLE-->
   </div>
</div>                        
                            


@endsection