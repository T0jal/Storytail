<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>STORYTAIL</title>
    <link rel="shortcut icon" href="{{ asset('images') }}/baseImages/favicon.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
<div id="app">
       <app></app>
</div>
<footer>
    <div class="logo-circle d-flex justify-content-center">
      <img src="images/baseImages/storytail-logo-06.png" class=".rounded-circle" alt="" width="70">
    </div>
    <div class="footer-top pb-3">
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a href="#" class="nav-link col-sm">Books</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link col-sm">Pricing</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link col-sm">Support</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link col-sm">Login</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link col-sm">Terms</a>
        </li>
      </ul>
  </div>
  <div class="footer-bottom py-2">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-4 text-center">
          <a href="#" class="">
              <span id="date" style="color:#eee">2021</span>
              storytail.pt</a>
        </div>
        <div class="col-4 text-right">
          <a href="#" class="pr-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="pr-3"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
  </footer>
   <script src="{{mix('js/app.js')}}"></script>
</body>
</html>
