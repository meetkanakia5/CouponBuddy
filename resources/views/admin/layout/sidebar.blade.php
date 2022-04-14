<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/favicon.ico') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">CB | Admin</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ \Auth::user()->first_name }} {{ \Auth::user()->last_name }} </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" @if(isset($sidebar_dashboard)) class="nav-link active" @else class="nav-link" @endif>
                      <i class="nav-icon fa fa-dashboard" style="color: white"></i>
                      <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" @if(isset($sidebar_admins)) class="nav-link active" @else class="nav-link" @endif>
                      <i class="nav-icon fa fa-user-circle" style="color: white"></i>
                      <p>Admin</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" @if(isset($sidebar_users)) class="nav-link active" @else class="nav-link" @endif>
                      <i class="nav-icon fa fa-users" style="color: white"></i>
                      <p>Users</p>
                    </a>
                </li>

                {{--  DropDown Categories  --}}
                <li @if(isset($sidebar_category)) class="nav-item has-treeview menu-open" @else class="nav-item has-treeview" @endif>
                    
                    <a href="#" @if(isset($sidebar_category)) class="nav-link active" @else class="nav-link" @endif>
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p> Category <i class="right fa fa-angle-left"></i> </p>
                    </a>

                    <ul class="nav nav-treeview">
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" @if(isset($sidebar_main_category)) class="nav-link active" @else class="nav-link" @endif>
                                <i class="nav-icon fa fa-circle-o nav-icon" style="color: white"></i>
                                <p>Main Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.sub-categories.index') }}" @if(isset($sidebar_sub_category)) class="nav-link active" @else class="nav-link" @endif>
                              <i class="nav-icon fa fa-circle-o nav-icon" style="color: white"></i>
                              <p>Sub-Category</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{--  End DropDown Categories  --}}

                <li class="nav-item">
                    <a href="{{ route('admin.establishments.index') }}" @if(isset($sidebar_establishments)) class="nav-link active" @else class="nav-link" @endif>
                      <i class="nav-icon fa fa-building" style="color: white"></i>
                      <p>Establishment</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.coupons.index') }}" @if(isset($sidebar_coupon)) class="nav-link active" @else class="nav-link" @endif>
                      <i class="nav-icon fa fa-gift" style="color: white"></i>
                      <p>Coupons</p>
                    </a>
                </li>

            </ul>
        </nav>
        
    </div>
    
</aside>