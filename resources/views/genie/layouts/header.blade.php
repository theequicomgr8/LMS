<div class="header-menu">
<div class="col-sm-7">
<a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
<div class="header-left">
</div></div>
<div class="col-sm-5"><div class="user-area dropdown float-right">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="user-avatar rounded-circle" src="{{asset('public/logo/logo.png')}}" alt="User Avatar">
</a>
<div class="user-menu dropdown-menu">
<a class="nav-link" href="{{url('admin/profile')}}"><i class="fa fa- user"></i>My Profile</a>
<a class="nav-link" href="{{url('admin/changepassword')}}"><i class="fa fa -cog"></i>Change Password</a>
<a href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>
</div>
</div>
</div>
</div>