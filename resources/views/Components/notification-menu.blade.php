<li class="nav-item dropdown" >
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span class="badge badge-warning navbar-badge" id="newCount">{{ $new }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header">{{ $total }} Notifications</span>

      
      @foreach ( $notifications as $notification )
     <div class="dropdown-divider"></div>
      <a href="{{ $notification->data['url'] }}?noty={{ $notification->id }} " class="dropdown-item">
          {{-- unread is function for checking if the notifications is readed or not --}}
        @if ($notification->unread())  
        <strong> * </strong>
        @endif  
          <span class="notification-text">{{ $notification->data['body'] }}</span>
          <span class="float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
        </a>
      
        @endforeach

      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
  </li>