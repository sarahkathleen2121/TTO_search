<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.dashboard') }}" key="t-default">Default</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">Layouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-vertical">Vertical</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="#" key="t-light-sidebar">Light Sidebar</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-horizontal">Horizontal</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="#" key="t-horizontal">Horizontal</a></li>
                                <li><a href="#" key="t-topbar-light">Topbar light</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="menu-title" key="t-apps">Apps</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-dashboards">Calendars</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-tui-calendar">TUI Calendar</a></li>
                        <li><a href="#" key="t-full-calendar">Full Calendar</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('bookings.index') }}" class="waves-effect">
                        <i class="bx bx-calendar-check"></i>
                        <span key="t-bookings">Bookings</span>
                    </a>
                </li>
                <li class="menu-title" key="t-content">Content Management</li>
                <li>
                    <a href="{{ route('blogs.index') }}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-blogs">Blogs</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog-categories.index') }}" class="waves-effect">
                        <i class="bx bx-purchase-tag-alt"></i>
                        <span key="t-blog-categories">Blog Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('moodboards.index') }}" class="waves-effect">
                        <i class="bx bx-image"></i>
                        <span key="t-moodboards">Moodboards</span>
                    </a>
                </li>
                
                <li class="menu-title" key="t-catalog">Catalog</li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-store"></i>
                        <span key="t-ecommerce">Products Catalog</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('products.index') }}" key="t-products">Products</a></li>
                        <li><a href="{{ route('brands.index') }}" key="t-brands">Brands</a></li>
                        <li><a href="{{ route('product-types.index') }}" key="t-product-types">Product Types</a></li>
                        <li><a href="{{ route('industries.index') }}" key="t-industries">Industries</a></li>
                        <li><a href="{{ route('spaces.index') }}" key="t-spaces">Spaces</a></li>
                        <li><a href="{{ route('materials.index') }}" key="t-materials">Materials</a></li>
                        <li><a href="{{ route('colors.index') }}" key="t-colors">Colors</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
