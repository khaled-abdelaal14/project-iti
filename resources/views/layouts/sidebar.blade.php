<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('admin/update-details')}}" class="nav-link" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Update Details</span> 
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('admin/update-password')}}" class="nav-link" aria-expanded="false" aria-controls="ui-basic">
            <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Update Password</span> 
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Admins</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/add-edit-admin')}}">Add Admin</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/admins')}}">Admins</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Books</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{route('books.create')}}">Add Book</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/books')}}">Books</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/borrowed-books')}}">Borrowed Books</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Students</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
           
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/students')}}">Show Students</a></li>
           
          </ul>
        </div>
      </li>



    </ul>
  </nav>