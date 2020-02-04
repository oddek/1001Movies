<?php
  include VIEW . 'head.php';
  include VIEW . 'header.php';
  ?>

<style>
  .card-img-top {
    width: 100%;
    height: 25vw;
    object-fit: cover;
}
</style>

<!-- Page Content -->

  <!-- Page Heading -->
  <h1 class="my-4">Movies
  </h1>
    <div class="container" id="filterDiv" style="padding: 12px 16px;">
      <div class="row">
        <label for="0">Search</label><input type="text" class="form-control myInput" id="0">
      </div>
      <br>
      <div class="row">
      <select class="mySel form-control form-control-inline" id="1">
        <option value="">All</option>
        <option value="1">Seen</option>
        <option value="0">Unseen</option>
      </select>
    </div>
      <br>
      <div class="row">
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year2"><label class="custom-control-label" for="year2">1900-1929</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year3"><label class="custom-control-label" for="year3">1930</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year4"><label class="custom-control-label" for="year4">1940</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year5"><label class="custom-control-label" for="year5">1950</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year6"><label class="custom-control-label" for="year6">1960</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year7"><label class="custom-control-label" for="year7">1970</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year8"><label class="custom-control-label" for="year8">1980</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year9"><label class="custom-control-label" for="year9">1990</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year10"
      ><label class="custom-control-label" for="year10">2000</label>
    </div>
    <div class="custom-control custom-checkbox custom-control-inline">
      <input type="checkbox" class="custom-control-input" id="year11"><label class="custom-control-label" for="year11">2010-Now</label>
    </div>
  </div>
  </div>

  <div class="row">
    <?php
      foreach($this->view_data as $movie)
      {
        echo('

         <div class="col-lg-3 col-md-4 col-sm-6 mb-4 movieCard lazy" 
          data-seen="'.(($movie->viewed) ? '1' : '0') .'"
          data-year2="'.(($movie->yearTag === 'year2') ? '1' : '0') .'"
          data-year3="'.(($movie->yearTag === 'year3') ? '1' : '0') .'"
          data-year4="'.(($movie->yearTag === 'year4') ? '1' : '0') .'"
          data-year5="'.(($movie->yearTag === 'year5') ? '1' : '0') .'"
          data-year6="'.(($movie->yearTag === 'year6') ? '1' : '0') .'"
          data-year7="'.(($movie->yearTag === 'year7') ? '1' : '0') .'"
          data-year8="'.(($movie->yearTag === 'year8') ? '1' : '0') .'"
          data-year9="'.(($movie->yearTag === 'year9') ? '1' : '0') .'"
          data-year10="'.(($movie->yearTag === 'year10') ? '1' : '0') .'"
          data-year11="'.(($movie->yearTag === 'year11') ? '1' : '0') .'"
          data-name="'.$movie->title.'">
          <div class="card h-100">
            <a href="/home/movie/' . $movie->id.'"><img class="card-img-top lazy" data-src="/content/img/' . $movie->posterUrl . '" alt=""></a>
            <div class="card-body d-flex flex-column">
              <h6 class="card-title">
                <a href="/home/movie/' . $movie->id.'">' . $movie->title . '</a><div class="text-muted">' . $movie->year . '
              </h6>
              <h7 class="card-subtitle mb-2 text-muted">' . $movie->genres . '</h7>

              <div class="checkbox ml-2 mt-auto ">
                <label class="checkbox-bootstrap checkbox-lg">                           
                <input id="seenCheckBox" name="'.$movie->id.'" type="checkbox"'. (($movie->viewed) ? 'checked' : '') . '>             
                <span class="checkbox-placeholder" style="margin-top: auto;"></span>           
                Seen
                </label>
              </div>

            </div>
          </div>  
       </div>
 
      ');
      }
    ?>
  </div>

<?php include VIEW . 'footer.php';?>

<script src="/content/scripts/script.js"></script>

<script>
    //LAZY LOADING IMAGES:
    //Uten denne så prøver nettleseren å laste inn alle postere samtidig.
    //Kopiert herfra: https://imagekit.io/blog/lazy-loading-images-complete-guide/
document.addEventListener("DOMContentLoaded", function() {
  var lazyloadImages;    

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".lazy");
    var imageObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.src = image.dataset.src;
          image.classList.remove("lazy");
          imageObserver.unobserve(image);
        }
      });
    });

    lazyloadImages.forEach(function(image) {
      imageObserver.observe(image);
    });
  } else {  
    var lazyloadThrottleTimeout;
    lazyloadImages = document.querySelectorAll(".lazy");
    
    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }    

      lazyloadThrottleTimeout = setTimeout(function() {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function(img) {
            if(img.offsetTop < (window.innerHeight + scrollTop)) {
              img.src = img.dataset.src;
              img.classList.remove('lazy');
            }
        });
        if(lazyloadImages.length == 0) { 
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
      }, 20);
    }

    document.addEventListener("scroll", lazyload);
    window.addEventListener("resize", lazyload);
    window.addEventListener("orientationChange", lazyload);
  }
})
</script>