@extends('admin/layout')
@section('page_title','Home Banner')
@section('home_banner_select','active')
@section('container')



@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
{{session('message')}}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
   </button>
</div>
@endif
<h1>Banner</h1><Br>
<a href="{{url('admin/home_banner/manage_home_banner')}}">
    <button type="button" class="btn btn-success">+Add Banner</button>
</a>

<div class="row m-t-30">
   <div class="col-md-12">
      <!-- DATA TABLE-->
      <div class="table-responsive m-b-40">
         <table class="table table-borderless table-data3">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Btn Txt</th>
                  <th>Btn Link</th>
                  <th>Action</th>
                  
               </tr>
            </thead>
            <tbody>
            @foreach($data as $list)
               <tr>
                  <td>{{$list->id}}</td>
                  <td>
                     <img src="{{asset('storage/media/banner/'.$list->image)}}" height="150px" width="150px">
                  </td>
                  <td>{{$list->btn_txt}}</td>
                  <td>{{$list->btn_link}}</td>
                  <td>
                     <a href="{{url('admin/home_banner/manage_home_banner/')}}/{{$list->id}}"><button class="btn btn-primary">Edit</button></a>
                     @if($list->status==1)
                     <a href="{{url('admin/home_banner/status/0')}}/{{$list->id}}"><button class="btn btn-warning">Active</button></a>
                     @elseif($list->status==0)
                     <a href="{{url('admin/home_banner/status/1')}}/{{$list->id}}"><button class="btn btn-secondary">Deactive</button></a>
                     @endif
                     <a href="{{url('admin/home_banner/delete/')}}/{{$list->id}}"><button class="btn btn-danger">Delete</button></a>
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