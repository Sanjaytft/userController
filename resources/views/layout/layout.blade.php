<!doctype html>
<html lang="en">
  <head>
  	<title>Multi-Auth App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/multiselect-dropdown.js') }}"></script>
    <style>
      .multiselect-dropdown{
        width:100% !important;
      }
    </style>
  </head>
  <body>

		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
        <ul class="list-unstyled components mb-5">

            @if(auth()->user()->role_id == 1)
            <h1><a href="" class="logo">Super Admin</a></h1>
                <li>
                    <a href="{{ route('superAdminUsers') }}"><span class="fa fa-users mr-3"></span>Manage all Users</a>
                </li>
                <li>
                  <a href="{{ route('departments.index') }}"><span class="fa fa-role mr-3"></span>Manage Department</a>
              </li>
                {{-- <li>
                  <a href="{{ route('departments.create') }}"><span class="fa fa-role mr-3"></span> Create Departments</a>
              </li> --}}
                {{-- <li>
                    <a href="{{ route('manageRole') }}"><span class="fa fa-role mr-3"></span> Manage all Roles</a>
                </li> --}}
                <li>
                  <a href="{{ route('super-admin.index') }}"><span class="fa fa-role mr-3"></span> Manage all Posts</a>
              </li>
              <li>
                <a href="{{ route('posts.create') }}"><span class="fa fa-role mr-3"></span> Create Posts</a>
            </li>
            @endif
            {{-- @if(auth()->user()->role == 2)
            <h1><a href="" class="logo">Sub Admin</a></h1>
                <li>
                  <a href="{{ route('posts.index') }}"><span class="fa fa-role mr-3"></span>Department Post</a>
              </li>
              <li>
                <a href="{{ route('posts.create') }}"><span class="fa fa-role mr-3"></span>Create Posts</a>
            </li>
            @endif --}}
            @if(auth()->user()->role_id == 2)
            <h1><a href="" class="logo">Admin Dashboard</a></h1>
            <li>
              <a href="{{ route('posts.index') }}"><span class="fa fa-role mr-3"></span>All Users Post</a>
          </li>
          <li>
            <a href="{{ route('posts.create') }}"><span class="fa fa-role mr-3"></span> Create Posts</a>
        </li>
          @endif
          @if(auth()->user()->role_id == 3)
          <h1><a href="" class="logo">User Dashboard</a></h1>
          <li>
            <a href="{{ route('posts.index') }}"><span class="fa fa-role mr-3"></span> User Posts</a>
        </li>
        <li>
          <a href="{{ route('posts.create') }}"><span class="fa fa-role mr-3"></span> Create Posts</a>
      </li>
      {{-- <li>
        <a href="{{ route('departments.create') }}"><span class="fa fa-role mr-3"></span> Create Posts</a>
    </li> --}}
          @endif

            <li>
                <a href="/logout"><span class="fa fa-sign-out mr-3"></span> Logout</a>
            </li>
        </ul>

    	</nav>

        <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5 pt-5">
                @yield('space-work')
            </div>
		</div>

    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
      <!-- Bootstrap JS and dependencies (optional) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
