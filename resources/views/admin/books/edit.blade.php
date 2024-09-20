@extends('layouts.layout')
@section('title')
    Edit book
@endsection
@section('other')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Book</h4>
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
      
        <form class="forms-sample" action="{{route('books.update',$book->id)}}" method="POST">
            @csrf
            @method('PUT')
          <div class="form-group">
            <label for="exampleInputName1">Title</label>
            <input type="text" name="title" class="form-control" value="{{$book->title}}" id="exampleInputName1" placeholder="Name">
          </div>
          <div class="form-group">
            <label for="exampleInputName1">Auther</label>
            <input type="text" name="auther" class="form-control" value="{{$book->auther}}" id="exampleInputName1" placeholder="Name">
          </div>

          <div class="form-group">
            <label class="col-sm-3 col-form-label">Date of publish</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" value="{{$book->published_year}}" name="published_year" placeholder="dd/mm/yyyy">
            </div>
          </div>

          <div class="form-group">
            <label for="exampleTextarea1">Body</label>
            <textarea name="body" class="form-control" id="exampleTextarea1" rows="4"> {{$book->body}}</textarea>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          
        </form>
      </div>
    </div>
  </div>
  @endsection