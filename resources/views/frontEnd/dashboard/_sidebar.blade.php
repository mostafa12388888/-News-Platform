<aside class="col-md-3 nav-sticky dashboard-sidebar">
<!-- User Info Section -->
<div class="user-info text-center p-3">
    <img src="/storage{{ auth()->user()->image }}" alt="User Image" class="rounded-circle mb-2"
        style="width: 80px; height: 80px; object-fit: cover" />
    <h5 class="mb-0" style="color: #ff6f61">Salem Taha</h5>
</div>

<!-- Sidebar Menu -->
<div class="list-group profile-sidebar-menu">
    <a href="{{ route('frontend.dashboard.profile') }}" class="list-group-item  {{$profileActive??''}} list-group-item-action menu-item"
        data-section="profile">
        <i class="fas fa-user"></i> Profile
    </a>
    <a href="{{ route('frontend.dashboard.notification') }}"
        class="list-group-item list-group-item-action {{$notificationActive??''}} menu-item" data-section="notifications">
        <i class="fas fa-bell"></i> Notifications
    </a>
    <a href="{{ route('frontend.dashboard.setting') }}" class="list-group-item {{$settingActive??''}} list-group-item-action menu-item"
        data-section="settings">
        <i class="fas fa-cog"></i> Settings
    </a>
    <a href="https://wa.me/{{$getSettings->phone}}" class="list-group-item  list-group-item-action menu-item"
        data-section="settings">
        <i class="fas fa-question" aria-hidden="true"></i> Support
    </a>
    <a href="javascript:void(0)" onclick="document.getElementById('formLogout').submit()" class="list-group-item  list-group-item-action menu-item"
        data-section="settings">
        <i class="fas fa-power-off" aria-hidden="true"></i> Logout
    </a>
    <form id="formLogout" action="{{route('logout')}}" method="post">@csrf</form>
</div>
</aside>
