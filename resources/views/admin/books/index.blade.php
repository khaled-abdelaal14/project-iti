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
                  <a class="btn btn-block btn-primary" style="max-width: 150px; float:right; display:inline-block; " href="{{url('admin/books/create')}}">Add Book</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="books" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>auther</th>
                      <th>Body</th>
                      <th>Published_year</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            
                  
                    <tr>
                      <td>#</td>
                      <td>{{$book->title}}</td>
                      <td>{{$book->auther}}</td>
                      <td>{{$book->body}}</td>

                      <td>{{date("F j, Y, g:i a", strtotime($book->published_year));}}</td>
                      <td>
                     
                        
                         <a style='color:#3f6ed3'; href="{{route('books.edit',$book->id)}}"> <i class="fas fa-edit"></i></a>
                         &nbsp;&nbsp;
                         <a class="confirmdelete" name="book" title="Delete book" style='color:#3f6ed3'; href="javascript:void{0}" record="book" recordid={{$book->id}} <?php /* href="{{url('book/delete-subbook',$subbook->id)}}" */ ?>> <i class="fas fa-trash"></i></a>
                        
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
