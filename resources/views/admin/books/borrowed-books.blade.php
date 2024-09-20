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
                      
                      <th>Published_year</th>
                   
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            
                  
                    <tr>
                      <td>#</td>
                      <td>{{$book->title}}</td>
                      <td>{{$book->auther}}</td>
                      

                      <td>{{date("F j, Y, g:i a", strtotime($book->published_year));}}</td>
                   
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
