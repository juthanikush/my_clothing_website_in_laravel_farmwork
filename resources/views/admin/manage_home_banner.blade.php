@extends('admin/layout')
@section('page_title','Manage Home Banner')
@section('home_banner_select','active')
@section('container')
<h1>Manage Banner</h1>
<Br>
<a href="{{url('admin/home_banner')}}">
<button type="button" class="btn btn-success">Back</button>
</a>
<div class="row m-t-30">
<div class="col-md-12">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <form action="{{route('home_banner.manage_home_banner_process')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <div class="row">
                        <div class="col-lg-6">
                           <label for="btn_txt" class="control-label mb-1">Button Name</label>
                           <input id="btn_txt" name="btn_txt" value="{{$btn_txt}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                        </div>
                        <div class="col-lg-6">
                           <label for="btn_link" class="control-label mb-1">Button Link</label>
                           <input id="btn_link" name="btn_link" type="text" value="{{$btn_link}}" class="form-control" aria-required="true" aria-invalid="false" >
                           @error('category_slug')
                           <div class="alert alert-danger" role="alert">
                              {{$message}}
                           </div>
                           @enderror
                        </div>
                        <div class="col-lg-12">
                                <label for="image" class="control-label mb-1">Banner Image</label>
                                <input id="image" name="image" type="file"  class="form-control" aria-required="true" aria-invalid="false">
                                @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                    
                                @enderror
                                @if($image!='')
                                        <a href="{{asset('storage/media/banner/'.$image)}}" traget="_blank"><img src="{{asset('storage/media/banner/'.$image)}}" height="150px" width="150px"></a>
                                @endif
                            </div>
                     </div>
                     <div><br>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        submit
                        </button>
                     </div>
                     <input type="hidden" name="id" value={{$id}} />
                    </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection