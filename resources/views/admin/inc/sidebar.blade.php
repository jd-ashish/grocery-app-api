<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('dashboard.userlist') }}">User List</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-products" aria-expanded="false"
                aria-controls="ui-products">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('product.category') }}">Category</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('product.index') }}">Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-offer" aria-expanded="false"
                aria-controls="ui-offer">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Offer</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-offer">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('offer.exclusive') }}">Exclusive Offer</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-setting" aria-expanded="false"
                aria-controls="ui-setting">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-setting">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('image.slider') }}">Image slider</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('general.setting') }}">General Setting</a></li>
                    @if(Auth::user()->user_type=="admin")
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('global.setting') }}">Setting</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('currency.index') }}">Currency</a></li>
                    @endif
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.list') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Order</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-refund" aria-expanded="false"
                aria-controls="ui-refund">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Refund</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-refund">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('order.cancel.refund') }}">Order Cancel Refund</a></li>

                            {{-- Pro version or upcomming --}}
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('product.index') }}">Refund request</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-conf" aria-expanded="false"
                aria-controls="ui-conf">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Configuration</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-conf">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('conf.sms') }}">SMS setup</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('conf.email') }}">Email setup</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('conf.cron') }}">Cron Job</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-Policy" aria-expanded="false"
                aria-controls="ui-Policy">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Policy</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-Policy">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('Terms.Conditions') }}">Terms & Conditions</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('return.policy') }}">Return Policy</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('contact.us') }}">Contact Us</a></li>
                    <li class="nav-item"> <a class="nav-link"
                        href="{{ route('about.us') }}">About Us</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
