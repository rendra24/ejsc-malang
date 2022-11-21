
<ul class="dropdown-menu" style="display: none;">
    @foreach($childs as $child)
      <li><a class="nav-link" href="{{ $child->link }}">{{ $child->display_name }}</a></li>
    @endforeach
  </ul>
