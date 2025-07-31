<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, minimum-scale=1, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <link rel="icon" type="image/png" href="" />
    <title>@yield('title') - {{ config('app.name', '') }}</title>

    {{-- style --}}
    @include('admin.layouts.style')
    @stack('custom-css')

    {{-- toastr style --}}
    <link rel="stylesheet" href="{{ asset('massage/toastr/toastr.css') }}">
    {{-- custom style --}}
    <style>
        .select2-container--default .select2-selection--single {
            height: 46px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px !important;
        }

        .select2-container--default .select2-selection--multiple {
            border-radius: 4px;
            border: 1px solid #ced4da;

            min-height: 46px !important;
        }

        .select2-container--default .select2-selection--multiple:focus-within {
            border-color: #ced4da;
            /* Change to your preferred focus color */
        }

        .select2-container--default .select2-dropdown .select2-search__field:focus,
        .select2-container--default .select2-search--inline .select2-search__field:focus {
            border: none !important;
        }


        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            color: #fff;
            border-radius: 4px;
            border: none;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            border: none;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: red;
            background-color: #007bff;
            border: none;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            padding: 0;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: white;

        }

        .dial_code_inp {
            background: #efefef;
            border-bottom-right-radius: 0px;
            border-top-right-radius: 0px;
            border-right: 0px;
        }

        .dropdown-menu.dropdown-menu-md.dropdown-menu-right.show .dropdown-item.profile {
            color: #000000 !important;
        }

        .dropdown-menu.dropdown-menu-md.dropdown-menu-right.show .dropdown-item.profile svg path {
            color: #000000 !important;
        }

        .dropdown-menu.dropdown-menu-md.dropdown-menu-right.show .dropdown-item.text-danger svg path {
            color: #dc3545 !important;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: #92c7ff;
        }

        @media (min-width: 992px) {
            .sidebar-mini .brand-logo {
                transition: all 0.3s ease;
            }

            .sidebar-mini.sidebar-collapse .brand-logo {
                max-width: 50px !important;
                max-height: 50px !important;
                transition: all 0.3s ease;
            }
        }

        .card-title {
            font-size: 1.5rem;
        }
    </style>

    @stack('style')
    <link href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- header area --}}
        @include('admin.layouts.header')
        {{-- sidebar area --}}
        @include('admin.layouts.sidebar')
        {{-- main content --}}
        @yield('content')
        {{-- footer --}}
        @include('admin.layouts.footer')

        {{-- javascript --}}
        @include('admin.layouts.script')

    </div>
    {{-- toastr javascript --}}
    <script src="{{ asset('massage/toastr/toastr.js') }}"></script>


    <script>
        $(document).ready(function() {
            const $body = $('body');
            const $toggleSidebarBtn = $('[data-widget="pushmenu"]');

            // Check and apply the sidebar state from localStorage
            const sidebarState = localStorage.getItem('sidebarState');
            if (sidebarState === 'collapsed') {
                $body.addClass('sidebar-collapse');
            } else {
                $body.removeClass('sidebar-collapse');
            }

            // Add event listener to toggle button
            $toggleSidebarBtn.on('click', function() {
                if ($body.hasClass('sidebar-collapse')) {
                    // $body.removeClass('sidebar-collapse');
                    localStorage.setItem('sidebarState', 'expanded');
                } else {
                    // $body.addClass('sidebar-collapse');
                    localStorage.setItem('sidebarState', 'collapsed');
                }
            });
        });
    </script>


    {{-- delete sweetalert2 --}}
    <script>
        $(document).on("click", ".deleteData", function(e) {
            e.preventDefault();
            var link = $(this).data("href");
            var title = $(this).data("title") ?? 'Are you sure?Are you want to delete?';
            var text = $(this).data("text") ?? 'Once Delete, This will be Permanently Delete!';
            var confirmText = $(this).data("confirm_text") ?? 'Yes, delete it!';
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#8bc34a',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmText
            }).then((willDelete) => {
                if (willDelete.isConfirmed) {
                    window.location.href = link;
                }
            })
        })
    </script>

    {{-- summernote --}}
    <script>
        $('.summernote').summernote({
            height: 200,
        })
        $('.select2').select2()
    </script>

    {{-- custom js area --}}
    @stack('script')


</body>

</html>
