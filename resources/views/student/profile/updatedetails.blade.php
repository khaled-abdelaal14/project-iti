@extends('layouts.layout')
@section('title')
    Update Details
@endsection
@section('other')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Settings</h4>
        <p class="card-description">
          Update Details
        </p>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @if(Session::has('erorr_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Erorr :</strong>{{Session::get('erorr_message')}} 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success :</strong>{{Session::get('success_message')}} 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <form class="forms-sample" action="{{url('student/update-details')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-9">
              <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" id="exampleInputUsername2" placeholder="Username">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" id="exampleInputEmail2" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
            <div class="col-sm-9">
              <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">city</label>
            <div class="col-sm-9">
              <input type="text" name="city" value="{{Auth::user()->city}}" class="form-control" id="exampleInputMobile" placeholder="City">
            </div>
          </div>
          @if(Auth::user()->image!= null)
          <div class="form-group">
            <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail" width="200px" height="200px" alt="...">
            
            <input type="hidden" value="{{Auth::user()->image}}" name="currentadminimage">
          </div>
          @endif
          
          <div class="form-group">
            <label for="admin_photo">Admin Photo</label>
            <input type="file"  class="form-control" id="admin_photo"  name="image">
          </div>
  
      
    
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
         
        </form>
      </div>
    </div>
  </div>
@endsection