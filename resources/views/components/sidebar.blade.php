 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
     </a> -->

     <div class="sidebar-brand d-flex align-items-center justify-content-center">
         <button class="rounded-circle border-0 mt-3" id="sidebarToggle"></button>
         <div class="sidebar-brand-text mx-3" style="font-size:15px;">Aplikasi PPDB <br>SDN 1 Kretek</div>
     </div>



     <!-- Nav Item - Dashboard -->


     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
         <a class="nav-link" href="/admin/dashboard">
             <i class="fas fa-home"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Pengelolaan
     </div>
     <li class="nav-item {{ Request::is('admin/informasi*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2" href="/admin/informasi">
             <i class="fas fa-info-circle"></i>
             <span>Kelola Jadwal PPDB</span></a>
     </li>
     <li class="nav-item {{ Request::is('admin/pengumuman*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2" href="/admin/pengumuman">
             <i class="fas fa-bullhorn"></i>
             <span>Kelola Pengumuman</span></a>
     </li>


     <hr class="mt-2 sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Main Menu
     </div>

     <li class="nav-item  {{ Request::is('admin/pendaftaran*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2" href="/admin/pendaftaran">
             <i class="fas fa fa-file-text-o"></i>
             <span>Data Pendaftaran</span>
         </a>
     </li>


     <li class="nav-item {{ Request::is('admin/wali*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2" href="/admin/wali">
             <i class="fas fa fa-users"></i>
             <span>Data Wali Siswa</span>
         </a>
     </li>
     <li class="nav-item {{ Request::is('admin/daftarulang*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2" href="/admin/daftarulang">
             <i class="fas fa fa-file-o"></i>
             <span>Data Daftar Ulang</span></a>
     </li>


     <!-- Divider -->
     <hr class="mt-3 sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading mt-2 mb-2">
         Laporan
     </div>
     <li class="nav-item {{ Request::is('admin/laporanpendaftaran*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2 mb-2" href="/admin/laporanpendaftaran">
             <i class="fas fa-info-circle"></i>
             <span>Laporan Pendaftaran</span>
         </a>
     </li>

     <!-- <li class="nav-item {{ Request::is('admin/spp*') ? 'active' : '' }}">
         <a class="nav-link px-3 py-2 mb-3" href="/admin/spp">
             <i class="fas fa-info-circle"></i>
             <span>Laporan Daftar Ulang</span></a>
     </li> -->

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block mb-2">

     <style>
         .pointer-cursor {
             cursor: pointer;
         }
     </style>

     <li class="nav-item">
         <a class="nav-link px-3 py-2" href="/">
             <i class="fas fa-list-alt"></i>
             <span>Menuju Homepage</span></a>
     </li>
     <li class="nav-item pointer-cursor" data-toggle="modal" data-target="#logoutModal">
         <a class="nav-link px-3 py-2">
             <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
             <span>Logout</span></a>
     </li>

     <!-- Sidebar Message -->
 </ul>
 <!-- End of Sidebar -->
