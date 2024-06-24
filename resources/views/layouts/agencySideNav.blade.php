<section class="side--nevbar--section">
    <div class="site--logo">
        <img src="{{ global_asset('images/vlogo.jpeg') }}" />
    </div>
    <div class="hamburger--section">
        <img src="{{ global_asset('images/leftarrow.png') }}" />
    </div>
    <div class="menu--bar--sec">
        <ul>
            <li class="list--sec">
               <a  href="{{ route('dashboard') }}"  {{ Request::is('*') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/dash.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">Dashboard</h3>
                  </span>
               </a>
            </li>
        </ul>
    </div>
    <div class="menu--bar">
        <ul>
            <li class="list--sec">
               <a href="/leads" {{ Request::is('leads') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/group.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">View Lead</h3>
                  </span> 
               </a>
            </li>
            
            <li class="list--sec dropdown--menu">
               <a href="#"  {{ Request::is('customer') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/managecust.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">Manage Customer</h3>
                  </span> 
                  <span class="drop--arrow">
                  <img src="{{ global_asset('images/droparrow.svg') }}" />
                  </span> 
               </a>

                   <ul class="dropdown--sub--menu">
                   <li class="list--sec">
               <a href="/customer/create" {{ Request::is('customer/create') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/addcust.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">Add Customer</h3>
                  </span> 
               </a>
            </li>
            <li class="list--sec">
               <a href="/customers" {{ Request::is('customers') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/viewcust.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">View Customer</h3>
                  </span> 
               </a>
            </li>
        </ul>
    </div>
</section>