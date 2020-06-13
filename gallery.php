<!DOCTYPE html>
<html>
<head>
    <title>Natours HealthCAre</title>
   <!-- add css --> 
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Natours Healthcare">
    <meta name="keywords" content="HealthCAre,Hospital,Doctors,Patients">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/gallery.css">
</head>
<body>
<!-- Navbar Start -->
<div class="nav">
    <div class="nav-header">
        <div class="nav-title">
            <img src="assets/img/logo-white.png" alt="Logo" class="header__logo">
        </div>
    </div>
    <div class="nav-links">
        <ul>
        <li><a href="index" >Home</a></li>
        <li><a href="about" >About</a></li>
        <li><a href="gallery" >Gallery</a></li>
        <li><a href="contact" >Contact</a></li> 
        <li class="dropdown"><a href="user/index" >Service</a></li>
        </li>  
    </ul>
    </div>
    <div class="nav-contact">
            <a href="user/index" >Login </a>
    </div>
</div>
<!--Navbar End  --->
<h3 class="heading-secondary">Gallery</h3>

<div class="row">
  <div class="column">
    <img src="assets/img/service-1.jpg" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
  </div>
  <div class="column">
    <img src="assets/img/services2.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
  </div>
  <div class="column">
    <img src="assets/img/services3.png" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
  </div>
  <div class="column">
    <img src="assets/img/services4.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
  </div>
</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="assets/img/service-1.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img src="assets/img/services2.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img src="assets/img/services3.png" style="width:100%">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img src="assets/img/services4.jpg" style="width:100%">
    </div>

     <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="assets/img/service-1.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img src="assets/img/services2.jpg" style="width:100%">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img src="assets/img/services3.png" style="width:100%">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img src="assets/img/services4.jpg" style="width:100%">
    </div>
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="img_nature_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="Service">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_snow_wide.jpg" style="width:100%" onclick="currentSlide(2)" alt="healthcare">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_mountains_wide.jpg" style="width:100%" onclick="currentSlide(3)" alt="CheckUp Health">
    </div>
    <div class="column">
      <img class="demo cursor" src="img_lights_wide.jpg" style="width:100%" onclick="currentSlide(4)" alt="Healthcare">
    </div>
  </div>
</div>




<!-- main end -->
    <!-- footer start -->
    <footer class="footer">
        <div class="footer__logo-box">
            <picture class="footer__logo">
                <source srcset="assets/img/logo-green-small-1x.png 1x, img/logo-green-small-2x.png 2x" media="(max-width:37.5em)">
                    <img srcset="assets/img/logo-green-1x.png 1x, img/logo-green-2x.png 2x" alt="full logo">
            </picture>
            
        </div>
        <div class="row">
            <div class="col-1-of-2">
                <div class="footer__navigation">
                    <ul class="footer__list">
                        <li class="footer__item"><a class="footer__link" href="home.html">Home</a></li>
                        <li class="footer__item"><a class="footer__link" href="about.html">About</a></li>
                        <li class="footer__item"><a class="footer__link" href="gallery.html">Gallery</a></li>
                        <li class="footer__item"><a class="footer__link" href="contact.html">Contact</a></li>
                        <li class="footer__item"><a class="footer__link" href="service.html">Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-1-of-2">
                <p class="footer__copyright">
                    Built By <a class="footer__link" href="home.html">Natours HealthCare</a> 
                </p>
            </div>
                    
        </div>
    </footer>
<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
    
</body>
</html>
