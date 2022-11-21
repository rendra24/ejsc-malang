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
        {{-- <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
            <li class=active><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul>
        </li> --}}
        <li class="menu-header">Menu</li>
        
        
        {{-- @foreach($menus as $menu)
        @if(count($menu->childs))
        <li class="dropdown">
            <a href="{{ $menu->link }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="{{ $menu->icon }}"></i> <span>{{ $menu->display_name }}</span></a>
            @if(count($menu->childs))
              @include('layouts.childSidebar',['childs' => $menu->childs])
            @endif
        </li>
        @else
          <li> <a class="nav-link" href="{{ $menu->link }}"><i class="{{ $menu->icon }}"></i> <span>{{ $menu->display_name }}</span></a></li>
        @endif
        @endforeach --}}
  
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
       
        {{-- <li> <a class="nav-link" href="/users"><i class="far fa-solid fa-user-group"></i> <span>Users</span></a></li> --}}


         
        
       
        
      </ul>
            </aside>
  </div>