
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>lharoui elmehdi</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- SEARCH FORM -->

      <div class="input-group input-group-sm" >
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar"  @click="searchit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>



  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-5 " >
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/user.png" alt="lHAroui" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text" style="color: #343a40;">trip porject</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/user.png" class="img-circle elevation-2" alt="elmehdi">
        </div>
        <div class="info">
            <span class="brand-text" style="color: #343a40;">{{ Auth::user()->name }}</span>
            <p>{{ Auth::user()->type }}</p>
            </div>

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <router-link to="/Dashbor-d" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt blue"></i>
                  <p>
                    table de bord

                  </p>
                </router-link>
              </li>

              @can('isAdmin')

          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog green"></i>
              <p>
                management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="nav-icon fas fa-users orang"></i>
                  <p>utilisateurs</p>
                </router-link>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>

            </ul>
          </li>
          @endcan
          <li class="nav-item">
            <router-link to="/Pofile-User" class="nav-link">
              <i class="nav-icon fas fa-user orang "></i>
              <p>
                profile

              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add_post" class="nav-link">
              <i class="nav-icon fas fa-align-justify teal "></i>
              <p>
                Add Request

              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/Request" class="nav-link">
              <i class="nav-icon fas fa-car teal "></i>
              <p>
                request's
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/add_offer" class="nav-link">
              <i class="nav-icon fas fa-car purple "></i>
              <p>
                Add Offer
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/offers" class="nav-link">
              <i class="nav-icon fas fa-align-justify purple "></i>
              <p>
                 Offer's
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>
                  <p>

                    {{ __('Logout') }}
             </p>
                </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <vue-progress-bar></vue-progress-bar>

        <router-view></router-view>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@auth
<script>
    window.user=@JSON(auth()->user())
    </script>
@endauth
<!-- AdminLTE App -->
<script src="/js/app.js"></script>
</body>
</html>




