<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel')) </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset(setting("favicon")) }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    @yield('style')

    <style>
        .loader {
          background: #ffffff;
          opacity: 0.7;
          width: 100%;
          height: 100%;
          line-height: 50px;
          text-align: center;
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          font-family: helvetica, arial, sans-serif;
          font-weight: 900;
          letter-spacing: 0.2em;
          z-index: 9999999;
          display:none;
        }
        .loader span {
          position: absolute;
          width: 250px;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: #000;
          text-transform: uppercase;
        }
        .loader span::before,
        .loader span::after {
          content: "";
          display: block;
          width: 15px;
          height: 15px;
          background: #ED5E29;
          position: absolute;
          animation: load 0.7s infinite alternate ease-in-out;
        }
        .loader span::before {
          top: 0;
        }
        .loader span::after {
          bottom: 0;
        }
        @keyframes load {
          0% {
            left: 0;
            height: 30px;
            width: 15px;
          }
          50% {
            height: 8px;
            width: 40px;
          }
          100% {
            left: 235px;
            height: 30px;
            width: 15px;
          }
        }

        .pointer{
            cursor: pointer;
        }

        </style>
        <style>
            /* width */
            ::-webkit-scrollbar {
              width: 5 px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
              box-shadow: inset 0 0 5px grey;
              border-radius: 8px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
              background: #71C016;
              border-radius: 10px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
              background: #71C016;
            }
            </style>
</head>

<body>
    <input type="hidden" value="{{ csrf_token() }}" class="token"/>
    <input type="hidden" value="{{ route('media.delete') }}" class="media_delete"/>
    <input type="hidden" value="{{ route('media.update.alt') }}" class="media_update_alt"/>
    <input type="hidden" value="{{ route('media.library') }}" class="media_library"/>
    <div class="loader" ><span>Loading...</span></div>
    <div class="container-scroller">
        @include('admin.inc.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            @include('admin.inc.sidebar')
            @include('admin.inc.model')

            @yield('content')
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function toast(message,type){
            var typ = "";
            if(type=="success"){
                typ = "linear-gradient(to right, #00b09b, #96c93d)";
            }else{
                typ = "linear-gradient(to right, #ff0000, #96c93d)";
            }
            Toastify({
                text: message,
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: typ,
                },
                onClick: function(){} // Callback after click
            }).showToast();
        }
    </script>

    @if(session("success"))
        <script>
            toast("{{ session('success') }}","success");
        </script>
    @endif

    @if(session("error"))
        <script>
            toast("{{ session('error') }}","success");
        </script>
    @endif
    <script>
        $(document).ready(function(){
            $(".load").click(function(){
                $(".loader").show();
            });
            $(".hide").hide();
        });

    </script>


    <script>
        // $('.myModal').modal('show');
            $(".cnf-del").click(function(){
                var route = $(this).attr('route');


                $(".delete_form").attr('action',route);
                $('.myModal').modal("show");

                var attr_name = $(this).attr('attr-name');
                if(attr_name){
                    $(".delete_form_title").html(attr_name);
                    $(".delete_form_btn_name").html(attr_name);
                }


            })
            $(".close").click(function(){
                var route = $(this).attr('model-iid');
                $(route).modal('hide');

            })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>



    @yield('script')
</body>

</html>
