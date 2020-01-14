<?php 
	 include VIEW . 'head.php';
	 include VIEW . 'header.php';

?>

<style>
	.jumbotron {
    background-image: linear-gradient(
      rgba(0, 0, 0, 0.5),
      rgba(0, 0, 0, 0.5)
    ), url('/content/img/background1.jpg');
    background-size: cover;
    height: 80%;
    color: white;
  }
</style>

<div class="jumbotron jumbotron-fluid mb-0">
   <div class="container">
    <div class="row justify-content-center text-center">
     <div class="col-md-10 col-lg-6">
      <h1 class="display-6">1001 Movies You Must See Before You Die</h1>
      <p class="lead">"The longer you wait, the harder it gets"</p>

      <p class="lead">
       <a class="btn btn-dark btn-lg" href="/home/movies" role="button">Explore!</a>
      </p>
     </div>
    </div>
   </div>
  </div>


 <!--<section id="sec-about" class="sec-about pt-5 pb-5">-->
  <!--<div class="container">
   <div class="row justify-content-center text-center">
    <div class="col-md-10 col-lg-8">
      <br>
     <h1 class="h4">About</h1>
     <p class="mt-4 mb-4">We've tried to make your journey through Steven Schneider's book a bit more structured. Tag the movies you have seen, and feel the dopamine rush as the progress bar turns green! </p>
    </div>
   </div>-->
<!--
   <div class="row mt-4">
    <div class="col-sm-4">
     <h4>350</h4>

     <hr />

     <h5>members</h5>
    </div>

    <div class="col-sm-4">
     <h4>60</h4>

     <hr />

     <h5>co-working spaces </h5>
    </div>

    <div class="col-sm-4">
     <h4>3</h4>

     <hr />

     <h5>members' bars</h5>
    </div>
   </div>
  </div>
 
-->
 



<?php include VIEW . 'footer.php';?>