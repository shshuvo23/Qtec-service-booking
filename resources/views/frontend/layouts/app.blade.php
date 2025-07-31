<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - {{ config('app.name', $settings->site_name) }}</title>
    <!-- meta -->
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta name="author" content="{{ config('app.name', $settings->site_name) }}" />
    <meta name="Developed By" content="{{ config('app.name', $settings->site_name) }}" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $settings->seo_meta_description }}">
    <meta property="og:image" content="{{ getPhoto($settings->site_logo) }}" />
    <meta property="og:site_name" content="{{ config('app.name', $settings->site_name) }}">
    <meta property="og:title" content="Home - {{ config('app.name', $settings->site_name) }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $settings->seo_meta_description }}">
    <!-- favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ getPhoto($settings->favicon) }}" />
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css?v=5.2') }}">
    <link rel="stylesheet" href="{{ asset('massage/toastr/toastr.css') }}">
    <style>
        .modal-blur {
            -webkit-backdrop-filter: blur(4px);
            backdrop-filter: blur(4px);
        }

        .custom-tooltip .tooltip-inner {
            text-align: left !important;
        }

        .smart-button {
            color: white;
            background: #ff942f;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .smart-button:hover {
            transform: scale(1.05);
            background: #ff942f;
            box-shadow: 0px 4px 15px rgba(255, 89, 98, 0.5);
        }

        .pointer {
            cursor: pointer;
        }
    </style>
    @stack('custom-css')
</head>

<body>

    {{-- Header --}}
    <div class="header_sec">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ getLogo($settings->site_logo) }}" alt="{{ $settings->site_name }}"
                            style="max-width: 220px; max-height: 90px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto pb-4 pt-4 pt-lg-0 pb-lg-0 align-items-center">
                            <a class="btn btn-dark rounded-pill px-4 py-2 d-inline ms-3"
                                href="@auth {{ route('user.dashboard') }} @else {{ route('login') }} @endauth">
                                @auth Dashboard
                                @else
                                Login @endauth
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    {{-- Header --}}



    @yield('content')



    {{-- footer --}}
    <footer class="footer_sec py-3">
        <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
                <div class="order-lg-2 mb-4 mb-lg-0 text-center footer_logo">
                    <img src="{{ getLogo($settings->site_logo) }}" alt="{{ $settings->site_name }}" class="img-fluid rounded"
                        style="max-width: 220px; max-height: 90px;">
                </div>
                <div class="copyright order-lg-1 mb-4 mb-lg-0 text-center text-lg-end">
                    <p class="m-0">
                        {{ $settings->copyright_text }}
                    </p>
                </div>

                {{-- <div class="order-lg-3 mb-4 mb-lg-0 text-lg-end">
                    <div class="footer_menu">
                        <ul class="m-0 d-flex align-items-center justify-content-center justify-content-lg-end">
                            @if (!empty($policy_section))
                                <li class="me-3">
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="custom-tooltip"
                                        data-bs-title="Your privacy is important to us. We only collect the contact information submitted by visitors, which is used solely for the purposes for which it was provided. We are committed to maintaining the confidentiality and security of this data and take appropriate measures to protect it from unauthorized access, alteration, or disclosure.">
                                        {{ $policy_section->title }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </footer>
    {{-- footer --}}

    {{-- scroll to top --}}
    <div class="scroll_top">
        <i class="fa fa-angle-up"></i>
    </div>

    {{-- Modal --}}
    {{-- <div class="modal modal-blur fade" id="freeTrailModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content shadow-md">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Contact</h5>

                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="freeTrialForm" action="{{ route('request.submit') }}" method="post">
                    @csrf

                    <input type="hidden" name="request_for" id="request_for" value="trial">
                    <div class="modal-body px-xl-5">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="full_name" id="full_name" class="form-control"
                                placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="company" id="company" class="form-control"
                                placeholder="Enter your company name" required>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="message" id="message" class="form-control" required placeholder="Enter your message"></textarea>
                        </div>



                        @if ($settings->recaptcha_status == '1' && $settings->recaptcha_site_key)
                            <input type="hidden" name="g-recaptcha-response" class="g-recaptcha-response">
                        @endif
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 mb-4 mt-4 g-recaptcha">Send</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div> --}}


    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


    <script>
        $(document).ready(function () {
            function ajaxFormSubmit(formId, modalId) {
                $(formId).on('submit', function (e) {
                    e.preventDefault();

                    let form = $(this);
                    let actionUrl = form.attr('action');
                    let submitButton = form.find('button[type="submit"]');
                    let originalButtonText = submitButton.html();

                    submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Sending...');

                    function sendAjaxForm() {
                        let formData = form.serialize();

                        $.ajax({
                            type: 'POST',
                            url: actionUrl,
                            data: formData,
                            success: function (response) {
                                $(modalId).modal('hide');
                                form.trigger('reset');
                                toastr.success(response.message || 'Your request is submitted successfully', 'Success', {
                                    positionClass: "toast-top-right"
                                });
                            },
                            error: function (xhr) {
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    for (let key in errors) {
                                        toastr.error(errors[key][0], 'Error', {
                                            positionClass: "toast-top-right"
                                        });
                                    }
                                } else {
                                    toastr.error(xhr.responseJSON?.message || 'An error occurred. Please try again.', 'Error', {
                                        positionClass: "toast-top-right"
                                    });
                                }
                            },
                            complete: function () {
                                submitButton.prop('disabled', false).html(originalButtonText);
                            }
                        });
                    }

                    @if ($settings->recaptcha_status == 1 && $settings->recaptcha_site_key)
                    if (typeof grecaptcha !== 'undefined') {
                        grecaptcha.ready(function () {
                            grecaptcha.execute("{{ $settings->recaptcha_site_key }}", { action: "submit" })
                                .then(function (token) {
                                    let recaptchaInput = form.find('.g-recaptcha-response');
                                    if (!recaptchaInput.length) {
                                        form.append('<input type="hidden" name="g-recaptcha-response" class="g-recaptcha-response">');
                                        recaptchaInput = form.find('.g-recaptcha-response');
                                    }

                                    recaptchaInput.val(token);
                                    sendAjaxForm();
                                })
                                .catch(function (error) {
                                    console.error("reCAPTCHA error:", error);
                                    toastr.error('reCAPTCHA failed to generate token. Try again.', 'reCAPTCHA Error');
                                    sendAjaxForm();
                                });
                        });
                    } else {
                        toastr.error('reCAPTCHA not loaded. Please check your site key.', 'reCAPTCHA Error');
                        sendAjaxForm();
                    }
                    @else
                    sendAjaxForm(); // reCAPTCHA disabled
                    @endif
                });
            }

            ajaxFormSubmit('#freeTrialForm', '#freeTrailModal');
            ajaxFormSubmit('#signupForm', '#signUpModal');
            ajaxFormSubmit('#buyNowForm', '#buyNowModal');
        });

        // Global error listener to catch recaptcha loading errors
        window.addEventListener('error', function (e) {
            if (e.message && e.message.toLowerCase().includes('invalid site key')) {
                toastr.error('Invalid reCAPTCHA site key. Please contact support.', 'reCAPTCHA Error');
            }
        });
    </script>



    <script>
        $(".refresh_code").on("click", function() {
            $.get($(this).data("href"), function(data, status) {
                $(".codeimg").attr(
                    "src",
                    "" + mainurl + "/assets/images/capcha_code.png?time=" + Math.random()
                );
            });
        });
    </script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl =>
            new bootstrap.Tooltip(tooltipTriggerEl, {
                html: true
            })
        );
    </script>


    <script src="{{ asset('massage/toastr/toastr.js') }}"></script>
    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,
                });
            @endforeach
        @endif
    </script>

    <script>
        $(document).ready(function() {
            // Show or hide the scroll button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 500) {
                    $('.scroll_top').fadeIn();
                } else {
                    $('.scroll_top').fadeOut();
                }
            });
            // Scroll to top when the button is clicked
            $('.scroll_top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 1);
                return false;
            });
        });
    </script>

    <script>
        var mainurl = "{{ url('/') }}";

        $(document).ready(function() {
            $('.refresh_code').trigger('click');
        });

        $(document).on('click', '.refresh_code', function() {
            $.get($(this).data('href'), function(data, status) {
                $('.codeimg').attr("src", mainurl + "/assets/images/capcha_code.png?time=" + Math.random());
                $('.codeimg1').attr("src", mainurl + "/assets/images/capcha_code1.png?time=" + Math
                    .random());
                $('.codeimg2').attr("src", mainurl + "/assets/images/capcha_code2.png?time=" + Math
                    .random());
                $('.codeimg3').attr("src", mainurl + "/assets/images/capcha_code3.png?time=" + Math
                    .random());
            });
        });
    </script>

    {{-- help center --}}
    {{-- <script>
        window.fwSettings = {
            'widget_id': 203000000042
        };
        ! function() {
            if ("function" != typeof window.FreshworksWidget) {
                var n = function() {
                    n.q.push(arguments)
                };
                n.q = [], window.FreshworksWidget = n
            }
        }()
    </script> --}}

    <script type='text/javascript' src='https://euc-widget.freshworks.com/widgets/203000000042.js' async defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('[data-bs-target="#buyNowModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    var packageValue = this.getAttribute('data-package');
                    document.getElementById('package_name').value = packageValue;
                });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                const targetSection = this.getAttribute('data-target');

                if (window.location.pathname === "{{ route('home') }}") {
                    // If already on 'home', scroll smoothly to the section
                    scrollToSection(targetSection);
                } else {
                    // Save target section in sessionStorage before redirecting
                    sessionStorage.setItem('scrollTarget', targetSection);
                    window.location.href = "{{ route('home') }}";
                }
            });
        });

        function scrollToSection(target) {
            const targetSection = document.querySelector(target);
            if (!targetSection) return;

            const targetPosition = targetSection.offsetTop;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            const duration = 2000;
            let startTime = null;

            function smoothScroll(currentTime) {
                if (startTime === null) startTime = currentTime;
                const timeElapsed = currentTime - startTime;
                const scrollAmount = easeInOutQuad(timeElapsed, startPosition, distance, duration);

                window.scrollTo(0, scrollAmount);

                if (timeElapsed < duration) {
                    requestAnimationFrame(smoothScroll);
                }
            }

            function easeInOutQuad(t, b, c, d) {
                t /= d / 2;
                if (t < 1) return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            }

            requestAnimationFrame(smoothScroll);
        }

        // Check if there is a stored scroll target after redirection
        window.addEventListener('load', () => {
            const scrollTarget = sessionStorage.getItem('scrollTarget');
            if (scrollTarget) {
                setTimeout(() => {
                    scrollToSection(scrollTarget);
                    sessionStorage.removeItem('scrollTarget'); // Clear stored target
                }, 500); // Delay to ensure page is fully loaded
            }
        });
    </script>



    @stack('script')
</body>

</html>
