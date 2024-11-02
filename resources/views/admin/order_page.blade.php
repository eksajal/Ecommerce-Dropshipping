<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RoyalUI Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="admin/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="admin/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="admin/images/favicon.png" />





    <style>
        .form_container {
            width: 100%;
        }

        .div_center {
            border-left: 3px solid blue;
            border-right: 3px solid blue;
            margin: auto;
            text-align: center;
        }

        label {
            width: 150px;
        }

        input {
            width: 350px;
        }

        textarea {
            width: 350px;
            height: 100px;
        }

        .form-element {
            padding: 10px;
        }

        .intro {
            border-bottom: 3px solid blue;
            border-right: 3px solid blue;
            display: inline-block;
            font-size: 35px;
            text-align: center;
            margin: auto;
            padding: 5px;
            width: 350px;
            font-weight: bold;
        }

        input[type='submit'] {
            font-size: 18px;
            font-weight: bold;
            background: skyblue;
            border-left: 3px solid blue;
            border-right: 3px solid blue;
            transition: transform 0.5s ease;
        }

        input[type='submit']:hover {
            transform: scale(1.1);
        }

        th,
        td {
            border-bottom: 3px solid blue;
            text-align: center;
            padding: 5px;
        }
    </style>


</head>

<body>


    @if (session('message'))
        <div id="toast"
            style="position: fixed; top: 20px; right: 20px; background-color: green; color: white; padding: 10px 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); z-index: 9999;">
            <span>{{ session('message') }}</span>
            <button onclick="hideToast()"
                style="background: transparent; border: none; color: white; font-size: 16px; font-weight: bold; cursor: pointer;">&times;</button>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(hideToast, 10000); // Auto-hide after 10 seconds
            });

            function hideToast() {
                var toast = document.getElementById('toast');
                if (toast) {
                    toast.style.display = 'none';
                }
            }
        </script>

        @php
            session()->forget('message');
        @endphp
    @endif


    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo me-5" href="{{ url('redirect') }}"><img src="admin/images/logo.svg"
                        class="me-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('redirect') }}"><img
                        src="admin/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="ti-view-list"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="ti-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <!-- Authentication -->
                            <a href="#" class="nav-item nav-link logout-btn"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout <i class="ti-power-off menu-icon"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <style>
                                .logout-btn {
                                    color: black !important;
                                    padding: 8px 0px !important;
                                    padding-left: 8px !important;
                                    /* Reduced padding to eliminate vertical space */
                                    margin: 0;
                                    /* Removes any margin around the button */
                                    line-height: 1;
                                    /* Sets a compact line height */
                                    transition: background-color 0.3s ease, color 0.3s ease;
                                    text-decoration: none;
                                }

                                .logout-btn:hover {
                                    background-color: skyblue;
                                    color: black;
                                }
                            </style>
                        </a>
                    </li>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('redirect') }}">
                            <i class="ti-shield menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="{{ url('category_page') }}"
                            aria-expanded="false" aria-controls="ui-basic">
                            <i class="ti-palette menu-icon"></i>
                            <span class="menu-title">Category</span>
                            <i class="menu-arrow"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="{{ url('add_product_page') }}"
                            aria-expanded="false" aria-controls="ui-basic">
                            <i class="ti-palette menu-icon"></i>
                            <span class="menu-title">Add Products</span>
                            <i class="menu-arrow"></i>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('view_product_page') }}">
                            <i class="ti-layout-list-post menu-icon"></i>
                            <span class="menu-title">View Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('order_page') }}">
                            <i class="ti-pie-chart menu-icon"></i>
                            <span class="menu-title">Orders</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('reseller_products_page') }}">
                            <i class="ti-pie-chart menu-icon"></i>
                            <span class="menu-title">Reseller Products</span>
                        </a>
                    </li>


                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper" style="background: #a7c5e0;">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>

                                </div>

                            </div>


                        </div>


                        <div class="div_center">
                            <div class="form_container">
                                <div class="intro">
                                    <h1>Orders</h1>
                                </div>

                                <table>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Address1</th>
                                        <th>Address2</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Delivery Status</th>
                                        <th>Product Image</th>
                                        <th>Update Status</th>
                                        <th>Delete</th>
                                    </tr>

                                    @foreach ($data as $order)
                                        <tr>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->city }}</td>
                                            <td>{{ $order->address1 }}</td>
                                            <td>{{ $order->address2 }}</td>

                                            <!-- Loop through product details (assuming multiple products per order) -->
                                            <td>
                                                @if (is_array($order->product_name))
                                                    <ul>
                                                        @foreach ($order->product_name as $name)
                                                            <li style="border-bottom: 2px solid blue;">
                                                                {{ $name }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    {{ $order->product_name }}
                                                @endif
                                            </td>

                                            <td>
                                                @if (is_array($order->price))
                                                    <ul>
                                                        @foreach ($order->price as $price)
                                                            <li style="margin-bottom: 45px; margin-top: 45px;">
                                                                ${{ $price }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    {{ $order->price }}
                                                @endif
                                            </td>

                                            <td>
                                                @if (is_array($order->quantity))
                                                    <ul>
                                                        @foreach ($order->quantity as $quantity)
                                                            <li style="margin-bottom: 45px; margin-top: 45px;">
                                                                {{ $quantity }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    {{ $order->quantity }}
                                                @endif
                                            </td>

                                            <td>${{ $order->total }}</td>

                                            @if ($order->delivery_status == 'OnTheWay')
                                                <td><span style="color: green;">{{ $order->delivery_status }}</span>
                                                </td>
                                            @endif

                                            @if ($order->delivery_status == 'Rejected')
                                                <td><span style="color: red;">{{ $order->delivery_status }}</span>
                                                </td>
                                            @endif

                                            @if ($order->delivery_status == 'pending')
                                                <td><span style="color: blue;">{{ $order->delivery_status }}</span>
                                                </td>
                                            @endif


                                            <!-- Loop through product images -->
                                            <td>
                                                @if (is_array($order->product_img))
                                                    @foreach ($order->product_img as $img)
                                                        <img style="width: 50px; height: 50px; margin-top: 20px; margin-bottom: 20px;"
                                                            src="productImage/{{ $img }}" alt="">
                                                    @endforeach
                                                @else
                                                    <img style="width: 50px; height: 50px;"
                                                        src="productImage/{{ $order->product_img }}" alt="">
                                                @endif
                                            </td>

                                            <td>
                                                <div style="display: flex; flex-direction: column;">
                                                    <a class="btn btn-info"
                                                        href="{{ url('status_OnTheWay', $order->id) }}"
                                                        style="margin-bottom: 5px;">OnTheWay</a>
                                                    <a class="btn btn-danger"
                                                        href="{{ url('status_rejected', $order->id) }}">Rejected</a>
                                                </div>
                                            </td>

                                            <td><a class="btn btn-danger"
                                                    href="{{ url('delete_order', $order->id) }}">Delete</a></td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
                    href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a
                    href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
        </div>
    </footer>
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>
