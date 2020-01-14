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

         <div class="col-lg-3 col-md-4 col-sm-6 mb-4 movieCard" 
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
            <a href="/home/movie/' . $movie->id.'"><img class="card-img-top" src="/content/img/' . $movie->posterUrl . '" alt=""></a>
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


  <!-- Pagination -->

  <!--
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">1</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">3</a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
    </li>
  </ul>
-->



<?php include VIEW . 'footer.php';?>

<script src="/content/scripts/script.js"></script>


<script>
  /*
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
*/
</script>