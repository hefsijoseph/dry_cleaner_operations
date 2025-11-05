<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- style --}}
   @vite('resources/css/app.css')
  {{-- <script src="../js/script.js" defer></script> --}}
  {{-- script --}}
    @vite('resources/js/app.js')
</head>

<body>
  <header class="header">
    <nav class="navbar">
      <!-- <h1>Dry Cleaners Operations <br> Management System</h1> -->
      <div>
        {{-- <a href="#home">About Us</a> --}}
        <a href="#news" class="news">News</a>
        {{-- <a href="#contact">Contact</a> --}}
        <!-- <h3>Welcome</h3> -->
      </div>
      <img src="images/avatar.png" alt="avatar"
        style="margin-left:300px;  width: 90px; height: 90px; object-fit: cover; border-radius: 50%;">
    
      <a href="#!"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-down">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M6 9l6 6l6 -6" />
        </svg>
        
        </a>
        
    </nav>

  </header>

  <aside class="sidenav">
    <h2>DCO-MS</h2>

    <!-- <button class="dropdown-btn active"> <svg  xmlns="http://www.w3.org/2000/svg"  width="36"  height="36"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /><path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1" /><path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1" /></svg>Dashboard
      <i class="fa fa-caret-down"></i>
    </button> -->
    <div>
      <button class="dropdown-btn"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-users">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
          <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
          <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>Employee
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="http://127.0.0.1:5500/build/inde.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
            <path d="M9 12h6" />
            <path d="M12 9v6" />
          </svg> Add </a>
        <a href="http://127.0.0.1:5500/build/ndex.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
          </svg>View</a>
      </div>
      <button class="dropdown-btn"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-user">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
          <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
        </svg>Customer
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="http://127.0.0.1:5500/build/indx.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
            <path d="M9 12h6" />
            <path d="M12 9v6" />
          </svg>Add</a>
          <a href="http://127.0.0.1:5500/build/ndex.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
          </svg>View</a>
      </div>

        <button class="dropdown-btn"> <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-address-book"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" /><path d="M10 16h6" /><path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M4 8h3" /><path d="M4 12h3" /><path d="M4 16h3" /></svg>Address
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="http://127.0.0.1:5500/build/inde.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
            <path d="M9 12h6" />
            <path d="M12 9v6" />
          </svg> Add </a>
        <a href="http://127.0.0.1:5500/build/ndex.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
          </svg>View</a>
      </div>
      <button class="dropdown-btn"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-menu-order">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 10h16" />
          <path d="M4 14h16" />
          <path d="M9 18l3 3l3 -3" />
          <path d="M9 6l3 -3l3 3" />
        </svg>Order
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="http://127.0.0.1:5500/build/ix.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-plus">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
            <path d="M9 12h6" />
            <path d="M12 9v6" />
          </svg>Add</a>
        <a href="http://127.0.0.1:5500/build/inde.html"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
          </svg>View</a>
        <a href="http://127.0.0.1:5500/build/idex.html">Assigned Order</a>
      </div>
      <button class="dropdown-btn"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-cash">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M7 15h-3a1 1 0 0 1 -1 -1v-8a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v3" />
          <path d="M7 9m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" />
          <path d="M12 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
        </svg>Payment
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="http://127.0.0.1:5500/build/inx.html">Generate Bill</a>
        <a href="http://127.0.0.1:5500/build/dex.html">Review Bill</a>
      </div>
      <div class="line"></div>
      <button class="dropdown-btn"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path
            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
          <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
        </svg>Setting
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <a href="http://127.0.0.1:5500/build/x.html">Dark mode</a>
      </div>
    </div>
  </aside>

  <main class="main">
 
    @yield('content')
 

  </main>

  <footer class="footer">
    <p>Copright 2025 Designed and Created by Hefsi</p>
  </footer>
</body>

<!-- Mirrored from www.w3schools.com/howto/tryit.asp?filename=tryhow_css_sidenav_fixed by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Sep 2022 14:31:11 GMT -->

</html>