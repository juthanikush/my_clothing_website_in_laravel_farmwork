@extends('admin/layout')
@section('page_title','Manage Category')
@section('category_select','active')
@section('container')


<h1>Manage Category</h1><Br>
<a href="{{url('admin/category')}}">
    <button type="button" class="btn btn-success">Back</button>
</a>


<div class="row m-t-30">
   <div class="col-md-12">
 
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                        
                        <form action="{{route('category.manage_category_process')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                <label for="category_name" class="control-label mb-1">Category Name</label>
                                <input id="category_name" name="category_name" value="{{$category_name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                            
                              
                                
                           
                            <div class="col-lg-6">
                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" type="text" value="{{$category_slug}}" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('category_slug')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                    
                                @enderror
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                <label for="parent_categories_id" class="control-label mb-1">Parent Categories Id</label>
                                <select id="parent_categories_id" name="parent_categories_id" class="form-control" required>
                                 <option value="0">Select Categories</option>
                                 @foreach($category as $list)
                                 @if($parent_categories_id==$list->id)
                                 <option selected value="{{$list->id}}">
                                    @else
                                 <option value="{{$list->id}}">
                                    @endif
                                    {{$list->category_name}}
                                 </option>
                                 @endforeach
                              </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="category_image" class="control-label mb-1">Category Image</label>
                                <input id="category_image" name="category_image" type="file"  class="form-control" aria-required="true" aria-invalid="false">
                                @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                    
                                @enderror
                                @if($category_image!='')
                                        <a href="{{asset('storage/media/category/'.$category_image)}}" traget="_blank"><img src="{{asset('storage/media/category/'.$category_image)}}" height="150px" width="150px"></a>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="is_home" class="control-label mb-1">Show is Home Page</label>
                                <input id="is_home" name="is_home" type="checkbox" {{$is_home_selected}} >
                                  
                            </div>
                            </div>
                            <div><br>
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