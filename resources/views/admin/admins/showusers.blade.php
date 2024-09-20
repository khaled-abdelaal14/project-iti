@extends('layouts.layout')
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
                  <h3 class="card-title">Show Students</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="users" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Mobile</th>
                      <th>Email</th>
                      <th>Created on</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            
                  
                    <tr>
                      <td>#</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->email}}</td>

                      <td>{{date("F j, Y, g:i a", strtotime($user->created_at));}}</td>
                      <td>
                     
                        
                      
                         &nbsp;&nbsp;
                         <a class="confirmdelete" name="user" title="Delete user" style='color:#3f6ed3'; href="javascript:void{0}" record="user" recordid={{$user->id}} <?php /* href="{{url('user/delete-user',$subuser->id)}}" */ ?>> <i class="fas fa-trash"></i></a>
                        
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
