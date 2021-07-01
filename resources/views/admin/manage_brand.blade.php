@extends('admin/layout')
@section('page_title','Manage Brand')
@section('brand_select','active')
@section('container')

@error('image.*')
<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
{{$message}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
</button>
</div>
@enderror
<h1>Manage Brand</h1><Br>
<a href="{{url('admin/brand')}}">
    <button type="button" class="btn btn-success">Back</button>
</a>


<div class="row m-t-30">
   <div class="col-md-12">
 
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        
                        <form action="{{route('brand.manage_brand_process')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="brand" class="control-label mb-1">brand Name</label>
                                <input id="brand" name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image" class="control-label mb-1">Image</label>
                                <input id="image" name="image" type="file"  class="form-control" aria-required="true" aria-invalid="false" >
                                @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                    
                                @enderror
                                @if($image!='')
                                    <img src="{{asset('storage/media/brand/'.$image)}}" height="150px" width="150px">
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="is_home" class="control-label mb-1">Show is Home Page</label>
                                <input id="is_home" name="is_home" type="checkbox" {{$is_home_selected}} >
                                  
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    submit
                                </button>
                            </div>
                            <input type="hidden" name="id" value={{$id}} />
                        </form>
                    </div>
                </div>
            </div>
	    </div>
   </div>
</div>                        
                            


@endsection