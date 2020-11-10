<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
   -->
   
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item {{ url()->current() == 'http://localhost:8000/User/home' ? 'active' : '' }}  ">
          <a class="nav-link" href="{{ route('Dashboard') }}">
            <i class="material-icons">dashboard</i>
            <p>HOME</p>
          </a>
        </li>

        <li class="nav-item {{ url()->current() == 'http://localhost:8000/User/Categories' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('categories') }}">
            <i class="material-icons">person</i>
            <p>Categories</p>
          </a>
        </li>

        <li class="nav-item {{ url()->current() == 'http://localhost:8000/User/Products' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('products') }}">
            <i class="material-icons">content_paste</i>
            <p>Products</p>
          </a>
        </li>

        <li class="nav-item {{ url()->current() == 'http://localhost:8000/User/ProductPhoto' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('productPhotos') }}">
            <i class="material-icons">library_books</i>
            <p>Products Photos</p>
          </a>
        </li>

        
      </ul>
    </div>
  </div>