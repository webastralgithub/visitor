

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
               <a class="active" href="/"  {{ Request::is('/') ? 'class=active' : '' }}>
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
            <!-- <li class="stiote--text">
               <a class="menu--text" href="#">Stores</a>
            </li> -->
            <li class="list--sec">
               <a href="/tenant"  {{ Request::is('tenant') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/listageency.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">Agency List</h3>
                  </span> 
               </a>
            </li>
            <li class="list--sec">
               <a href="/tenant/create" {{ Request::is('tenant/create') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/addlist.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">Add Agency</h3>
                  </span> 
               </a>
            </li>
            <li class="list--sec">
               <a href="/invoices" {{ Request::is('invoices') ? 'class=active' : '' }}>
                  <span>
                     <img src="{{ global_asset('images/addlist.svg') }}" />
                  </span>
                  <span>
                     <h3 class="menu--text">Invoices</h3>
                  </span> 
               </a>
            </li>
        </ul>
    </div>
</section>