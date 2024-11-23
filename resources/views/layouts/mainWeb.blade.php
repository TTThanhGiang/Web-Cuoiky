<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="assets/web/img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>@yield('title', 'Default Title')</title>
	<!--
		CSS
		============================================= -->
    <link rel="stylesheet" href="{{ url('assets/web/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/ion.rangeSlider.skinFlat.css') }}">  
    <link rel="stylesheet" href="{{ url('assets/web/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('assets/web/css/main.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        /* Đưa toast ra giữa màn hình */
        .toast-center {
            top: 10% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
        }
        .category-link.active {
            color: #ffc107; /* Thay đổi màu chữ nếu cần */
        }
    </style>
</head>
<body >
    <header>
        <!-- Header nội dung -->
        @include('partials.header')
    </header>
    
    <main>
        @yield('content') 
    </main>
    <footer>
        <!-- Footer nội dung -->
        @include('partials.footer')
    </footer>
    <script src="{{ url('assets/web/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
    <script src="{{ url('assets/web/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/web/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('assets/web/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('assets/web/js/jquery.sticky.js') }}"></script>
    <script src="{{ url('assets/web/js/nouislider.min.js') }}"></script>
    <script src="{{ url('assets/web/js/countdown.js') }}"></script>
    <script src="{{ url('assets/web/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ url('assets/web/js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ url('assets/web/js/gmaps.min.js') }}"></script>
    <script src="{{ url('assets/web/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-center", // Đưa thông báo ra giữa màn hình
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        function updateHiddenQuantity() {
            var quantity = document.getElementById("sst").value;
            document.getElementById("hidden-quantity").value = quantity;
        }
        function increaseQuantity() {
            var quantityInput = document.getElementById("sst");
            var currentValue = parseInt(quantityInput.value) || 1;

            quantityInput.value = currentValue + 1;
            updateHiddenQuantity();
        }

        function decreaseQuantity() {
            var quantityInput = document.getElementById("sst");
            var currentValue = parseInt(quantityInput.value) || 1;

            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }

            updateHiddenQuantity();
        }

        document.getElementById("sst").addEventListener("input", updateHiddenQuantity);
    </script>
    @if (session('success'))
    <script>
        toastr["success"]("{{ session('success') }}", "Information", {
            closeButton: true,
            progressBar: true
        });
    </script>
    @endif
    @if (session('error'))
    <script>
        toastr["warning"]("{{ session('error') }}", "Information", {
            closeButton: true,
            progressBar: true
        });
    </script>
    @endif
    @if (session('verified'))
    <script>
        toastr["success"]("{{ session('verified') }}", "Information", {
            closeButton: true,
            progressBar: true
        });
    </script>
	@endif
</body>
</html>
