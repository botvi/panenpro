<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Home | Panenpro</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('env') }}/logo.png" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style-preset.css">
    @yield('style')

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('template-admin.navbar')
	
	
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    @include('template-admin.header')
   
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
	@yield('content')

    <!-- [ Main Content ] end -->
    {{-- <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">Panenpro &#9829;</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="/">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> --}}
    <!--end switcher-->
    @include('sweetalert::alert')

    @yield('script')
    <!-- [Page Specific JS] start -->
    <script src="{{ asset('admin') }}/assets/js/plugins/apexcharts.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('admin') }}/assets/js/plugins/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/fonts/custom-font.js"></script>
    <script src="{{ asset('admin') }}/assets/js/pcoded.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/feather.min.js"></script>





    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>

 <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
      // [ Zero Configuration ] start
      $('#simpletable').DataTable();

      // [ Default Ordering ] start
      $('#order-table').DataTable({
        order: [[3, 'desc']]
      });

      // [ Multi-Column Ordering ]
      $('#multi-colum-dt').DataTable({
        columnDefs: [
          {
            targets: [0],
            orderData: [0, 1]
          },
          {
            targets: [1],
            orderData: [1, 0]
          },
          {
            targets: [4],
            orderData: [4, 0]
          }
        ]
      });

      // [ Complex Headers ]
      $('#complex-dt').DataTable();

      // [ DOM Positioning ]
      $('#DOM-dt').DataTable({
        dom: '<"top"i>rt<"bottom"flp><"clear">'
      });

      // [ Alternative Pagination ]
      $('#alt-pg-dt').DataTable({
        pagingType: 'full_numbers'
      });

      // [ Scroll - Vertical ]
      $('#scr-vrt-dt').DataTable({
        scrollY: '200px',
        scrollCollapse: true,
        paging: false
      });

      // [ Scroll - Vertical, Dynamic Height ]
      $('#scr-vtr-dynamic').DataTable({
        scrollY: '50vh',
        scrollCollapse: true,
        paging: false
      });

      // [ Language - Comma Decimal Place ]
      $('#lang-dt').DataTable({
        language: {
          decimal: ',',
          thousands: '.'
        }
      });
    </script>
    <!-- [Page Specific JS] end -->

</body>
<!-- [Body] end -->

</html>
