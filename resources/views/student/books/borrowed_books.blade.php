@extends('layouts.layout')
@section('title')
Books
@endsection
@section('other')
<!-- Content Wrapper. Contains page content -->


  <!-- Content Header (Page header) -->

  <!-- /.content-header -->

    <!-- Main content -->
   
        
          <div class="row">
            <div class="col-12">
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success :</strong>{{Session::get('success_message')}} 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">books</h3>
                 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="books" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>auther</th>
                      <th>Borrowed At</th>
                      <th>Return By</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowedBooks as $borrowedBook)
                            
                  
                    <tr>
                      <td>#</td>
                      <td>{{$borrowedBook->title}}</td>
                      <td>{{$borrowedBook->auther}}</td>
                     

                      <td>{{date("F j, Y, g:i a", strtotime($borrowedBook->pivot->borrowed_at ));}}</td>
                      <td>{{date("F j, Y, g:i a", strtotime($borrowedBook->pivot->return_by ));}}</td>
                      <td>
                     
                        
                        <a class="btn btn-info" style="height: 40px; width: 80px; display: flex; align-items: center; justify-content: center;" href="{{url('student/borrowed-books',$borrowedBook->id)}}">
                         Un Borrow
                      </a>                      
                        
                        </td>
                    </tr>
                    @endforeach


                    </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        
        <!-- /.container-fluid -->
      
      <!-- /.content -->

<!-- /.content-wrapper -->
@endsection
