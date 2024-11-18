<!DOCTYPE html>
<html
  lang="en"
  xmlns:th="http://www.thymeleaf.org"
  th:fragment="layout(content)"
  xmlns="http://www.w3.org/1999/html"
>
  <head>
    <base href="/">
    <title>Karmar - Admin Product</title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta
      name="description"
      content="Portal - Bootstrap 5 Admin Dashboard Template For Developers"
    />
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media" />
    <link rel="shortcut icon" href="{{ url('assets/web/img/fav.png') }}" />
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- FontAwesome JS-->
    <script src="{{ url('assets/admin/js/all.min.js') }}"></script>
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ url('assets/admin/css/portal.css') }}" />
    <style>
      .container-product {
        width: 100%;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
      }

      .container-product h1 {
        font-size: 32px;
        margin-bottom: 20px;
        font-family: none;
        text-align: center;
        font-weight: bold;
      }
      .container-product form {
        display: flex;
        flex-direction: column;
      }

      .container-product label {
        margin-bottom: 10px;
      }

      .container-product input[type="text"],
      .container-product input[type="file"],
      .container-product input[type="number"],
      .container-product textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
      }
      .container-product input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        font-size: 16px;
      }

      .container-product input[type="submit"]:hover {
        background-color: #3e8e41;
      }
      .container-product select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body class="app">
    <header>
        <!-- Header nội dung -->
        @include('partials.adminHeader')
    </header>
    <main>
        @yield('content')
    </main>
    <script src="{{ url('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/admin/js/app.js') }}"></script>
    <script>
      function changeCategory(selectElement) {
        var selectedValue = selectElement.value;
        window.location.href = "/shoe-shop/admin/products?id=" + selectedValue;
      }

      function previewImage(event) {
        var input = event.target;
        var img = document.getElementById("preview_image");

        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            img.src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
        } else {
          img.src = img.getAttribute("data-default-image");
        }
      }
    </script>
  </body>
</html>
