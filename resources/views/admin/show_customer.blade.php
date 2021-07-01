@extends('admin/layout')
@section('page_title','Show Customer Details')
@section('customer_select','active')
@section('container')


<h1>Customer Details</h1><Br>


<div class="row m-t-30">
   <div class="col-md-6">
      <!-- DATA TABLE-->
      <div class="table-responsive m-b-40">
         <table class="table table-borderless table-data3">
            <thead>
               <tr>
                  <th>Field</th>
                  <th>Value</th>
                 
                  
               </tr>
            </thead>
            <tbody>
          
               <tr>
                  <td><strong>Name</strong></td>
                  <td>{{$customer_list->name}}</td>
               </tr>
               <tr>
                  <td><strong>Email</strong></td>
                  <td>{{$customer_list->email}}</td>
               </tr>
               <tr>
                  <td><strong>Mobile</strong></td>
                  <td>{{$customer_list->mobile}}</td>
               </tr>
               <tr>
                  <td><strong>Address</strong></td>
                  <td>{{$customer_list->address}}</td>
               </tr>
               <tr>
                  <td><strong>City</strong></td>
                  <td>{{$customer_list->city}}</td>
               </tr>
               <tr>
                  <td><strong>State</strong></td>
                  <td>{{$customer_list->state}}</td>
               </tr>
               <tr>
                  <td><strong>Zip</strong></td>
                  <td>{{$customer_list->zip}}</td>
               </tr>
               <tr>
                  <td><strong>Company</strong></td>
                  <td>{{$customer_list->company}}</td>
               </tr> 
               <tr>
                  <td><strong>GST Number</strong></td>
                  <td>{{$customer_list->gstin}}</td>
               </tr>
               <tr>
                  <td><strong>Added_on</strong></td>
                  <td>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i')}}</td>
               </tr>
               <tr>
                  <td><strong>Update_On</strong></td>
                  <td>{{\Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-Y h:i')}}</td>
               </tr>

            </tbody>
         </table>
      </div>
      <!-- END DATA TABLE-->
   </div>
</div>                        
                            


@endsection