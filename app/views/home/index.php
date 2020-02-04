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
<?php include VIEW . 'footer.php';?>