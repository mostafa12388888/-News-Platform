 <!-- Top Bar Start -->
 <div class="top-bar">
     <div class="container">
         <div class="row">
             <div class="col-md-6">
                 <div class="tb-contact">
                     <p><i class="fas fa-envelope"></i>info@mail.com</p>
                     <p><i class="fas fa-phone-alt"></i>+012 345 6789</p>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="tb-menu">
                     @guest
                         <a href="{{ route('register') }}">Register</a>
                         <a href="{{ route('login') }}">Login</a>
                     @endguest
                     @auth
                         <a href="javascript:void(0)"
                             onclick="if(confirm('Do you want to logout?')){ document.getElementById('formLogOut').submit(); } return false;">Log
                             out</a>

                         <form id="formLogOut" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

                     @endauth
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Top Bar Start -->

 <!-- Brand Start -->
 <div class="brand">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-3 col-md-4">
                 <div class="b-logo">
                     <a href="index.html">
                         <img src="{{'/storage'.  $getSettings->logo }}" alt="Logo" />
                     </a>
                 </div>
             </div>
             <div class="col-lg-6 col-md-4">
                 <div class="b-ads">
                     <a href="https://htmlcodex.com">
                         <img src="{{ asset('assets/frontEnd') }}/img/ads-1.jpg" alt="Ads" />
                     </a>
                 </div>
             </div>
             <div class="col-lg-3 col-md-4">
                 <div class="b-search">
                     <input type="text" placeholder="Search" />
                     <button><i class="fa fa-search"></i></button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Brand End -->

 <!-- Nav Bar Start -->
 <div class="nav-bar">
     <div class="container">
         <nav class="navbar navbar-expand-md bg-dark navbar-dark">
             <a href="#" class="navbar-brand">MENU</a>
             <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                 <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                 <div class="navbar-nav mr-auto">
                     <a href="/" class="nav-item nav-link active">Home</a>
                     <div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                         <div class="dropdown-menu">
                             @foreach ($categories as $category)
                                 <a href="{{ route('frontend.category.posts', $category->slug) }}" class="dropdown-item"
                                     title="{{ $category->name }}"> {{ $category->name }}</a>
                             @endforeach
                         </div>
                     </div>
                     <a href="{{ route('frontend.contact.index') }}" class="nav-item nav-link">Contact Us</a>
                     @auth
                         <a href="{{ route('frontend.dashboard.profile') }}" class="nav-item nav-link">Dashboard</a>

                     @endauth

                 </div>
                 <div class="social ml-auto">
                     <!-- Notification Dropdown -->
                     @auth

                         <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <i class="fas fa-bell"></i>
                             <span id="count-notification"
                                 class="badge badge-danger">{{ auth()->user()->unreadNotifications()->count() }}</span>
                         </a>
                         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown"
                             style="width: 300px;">
                             <h6 class="dropdown-header">Notifications</h6>

                             @forelse (auth()->user()->unreadNotifications()->limit(5)->get()  as $notify)
                                 <div id="push-notification">
                                     <div class="dropdown-item d-flex justify-content-between align-items-center">
                                         <span>Post comment :{{ substr($notify->data['post_title'], 0, 4) }}....</span>
                                         <a href="{{ $notify->data['link'] }}?notify={{ $notify->id }}">
                                             <i class="fa fa-eye"></i>
                                         </a>
                                         <form action="" method="POST">
                                             <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                         </form>
                                     </div>
                                 </div>

                             @empty
                                 <div id="push-empty" class="dropdown-item text-center">No notifications</div>
                             @endforelse


                         </div>
                     @endauth


                     <a href="{{ $getSettings->twitter }}" title='twitter'><i class="fab fa-twitter"></i></a>
                     <a href="{{ $getSettings->facebook }}" title='facebook'><i class="fab fa-facebook-f"></i></a>
                     <a href="{{ $getSettings->twitter }}" title='linkedin'><i class="fab fa-linkedin-in"></i></a>
                     <a href="{{ $getSettings->instagram }}" title='instagram'><i class="fab fa-instagram"></i></a>
                     <a href="{{ $getSettings->youtube }}" title='youtube'><i class="fab fa-youtube"></i></a>
                 </div>
             </div>
         </nav>
     </div>
 </div>
 <!-- Nav Bar End -->
