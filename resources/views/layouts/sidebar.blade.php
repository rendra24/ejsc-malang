<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="/dashboard">East Java Super Corridor</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="/dashboard">EJSC</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Menu</li>
        <li class="{{ (request()->is('dashboard') || request()->is('dashboard/*')) ? 'active' : '' }}"><a class="active" href="/dashboard"><i class="far fa-solid fa-gauge"></i> <span>Dashboard</span></a></li>
     
        <li class="menu-header">Menu</li>
        
        
  
        <li class="dropdown {{ (request()->is('laporan') || request()->is('laporan/*')) ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-solid fa-file-invoice"></i><span>Laporan</span></a>
          <ul class="dropdown-menu">
            <li class="{{ (request()->segment(2) == 'penggunjung') ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.penggunjung') }}">Penggunjung</a></li>
            <li class="{{ (request()->segment(2) == 'skm') ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.skm') }}">Survei Kepuasan</a></li>
            <li class="{{ (request()->segment(2) == 'indikator-kepuasan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.indikator-kepuasan') }}">Indikator Kepuasan</a></li>
            <li class="{{ (request()->segment(2) == 'kritik-saran') ? 'active' : '' }}"><a class="nav-link" href="{{ route('laporan.kritik-saran') }}">Kritik & Saran</a></li>
          </ul>
        </li>

        <li class="{{ (request()->is('anggota') || request()->is('anggota/*')) ? 'active' : '' }}"> <a class="nav-link" href="/anggota"><i class="far fa-solid fa-users"></i> <span>Anggota</span></a></li>
        <li class="{{ (request()->is('tujuan') || request()->is('tujuan/*')) ? 'active' : '' }}"> <a class="nav-link" href="/tujuan"><i class="far fa-solid fa-list"></i> <span>Tujuan</span></a></li>
        <li class="{{ (request()->is('profesi') || request()->is('profesi/*')) ? 'active' : '' }}"> <a class="nav-link" href="/profesi"><i class="far fa-solid fa-list"></i> <span>Profesi</span></a></li>
        <li class="{{ (request()->is('kuisioner') || request()->is('kuisioner/*')) ? 'active' : '' }}"> <a class="nav-link" href="/kuisioner"><i class="far fa-solid fa-list"></i> <span>Kuisioner</span></a></li>
       
        {{-- <li> <a class="nav-link" href="/users"><i class="far fa-solid fa-user-group"></i> <span>Users</span></a></li> --}}


         
        
       
        
      </ul>
            </aside>
  </div>