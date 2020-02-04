<?php 
	 include VIEW . 'head.php';
	 include VIEW . 'header.php';
     $movie = $this->view_data;
     $happyUrl = "content/img/happy.svg";
     $neutralUrl = "content/img/neutral.svg";
     $sadUrl = "content/img/sad.svg";
?>
<style>
	#comment{
margin-left: 20px;
box-shadow: 0 2px 0 #e6e6e6;
height: 40px;
padding-left: 10px;
width: 100%;
height: 200px;
}
#commentSubmit{
margin-left: 20px;
width: 250px;
height: 55px;
color: white;
font-size: 20px;
background-color: #2c95dc;
box-shadow: 0 3px 0 #09466f;
margin-bottom: 30px;
padding-left: 20px;
border-radius: 5px;
}
#commentSubmit:hover {
background-color: #09466f;
}

form#smileys input[type="radio"] {
  -webkit-appearance: none;
  width: 90px;
  height: 90px;
  border: none;
  cursor: pointer;
  transition: border .2s ease;
  -webkit-filter: grayscale(100%);
          filter: grayscale(100%);
  margin: 0 5px;
  transition: all .2s ease;
}
form#smileys input[type="radio"]:hover, form#smileys input[type="radio"]:checked {
  -webkit-filter: grayscale(0);
          filter: grayscale(0);
}
form#smileys input[type="radio"]:focus {
  outline: 0;
}
form#smileys input[type="radio"].happy {
  background: url("https://res.cloudinary.com/turdlife/image/upload/v1492864443/happy_ampvnc.svg") center;
  background-size: cover;
}
form#smileys input[type="radio"].neutral {
  background: url("https://res.cloudinary.com/turdlife/image/upload/v1492864443/neutral_t3q8hz.svg") center;
  background-size: cover;
}
form#smileys input[type="radio"].sad {
  background: url("https://res.cloudinary.com/turdlife/image/upload/v1492864443/sad_bj1tuj.svg") center;
  background-size: cover;
}

.mtt {
  position: fixed;
  bottom: 10px;
  right: 20px;
  color: #999;
  text-decoration: none;
}
.mtt span {
  color: #e74c3c;
}
.mtt:hover {
  color: #666;
}
.mtt:hover span {
  color: #c0392b;
}

.btn-sq-lg {
  width: 150px !important;
  height: 150px !important;
}

.btn-sq {
  width: 100px !important;
  height: 100px !important;
  font-size: 10px;
}

.btn-sq-sm {
  width: 50px !important;
  height: 50px !important;
  font-size: 10px;
}

.btn-sq-xs {
  width: 25px !important;
  height: 25px !important;
  padding:2px;
}
</style>

<h1 class="my-4"><?php echo($movie->title) ?>
    <small>[<?php echo($movie->year)?>]</small>
  </h1>

<div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-4">
        <img src="/content/img/<?php echo($movie->posterUrl) ?>">

    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $movie->plot?></h5>
        <p class="card-text">
            <small class="text-muted">Imdb Rating: <?php echo($movie->imdbRating) ?></small>
            <br>
            <small class="text-muted">1001 Rating: Not implemented yet<?php /*echo($movie->localRating) */?></small>
            <br>
            <small class="text-muted">Runtime: <?php echo($movie->runtime) ?> minutes</small>
            <br>
            <small class="text-muted">Director: <?php echo($movie->director) ?></small>
            <br>
            <small class="text-muted">Writers: <?php echo($movie->writers) ?></small>
            <br>
            <small class="text-muted">Actors: <?php echo($movie->actors) ?></small>
            <br>
            <small class="text-muted">Genre: <?php echo($movie->genres) ?></small>
            <br>
            <small class="text-muted">Country: <?php echo($movie->country) ?></small>
            <br>
            <small class="text-muted">Language: <?php echo($movie->language) ?></small>
            <br>
            <small class="text-muted">Rated: <?php echo($movie->rated) ?></small>
        </p>
        <p class="card-text">
            Users who have seen this movie:
            <div class="progress">
                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo (round($movie->viewsInPercent, PHP_ROUND_HALF_DOWN)) ?>%" aria-valuenow="<?php echo ($movie->viewsInPercent) ?>" aria-valuemin="0" aria-valuemax="100"><?php echo (round($movie->viewsInPercent, PHP_ROUND_HALF_DOWN)) ?>%</div>
            </div>
        </p>
        <br>
        <div class="row justify-content-around align-self-center">

                <div class="checkbox align-self-center">
                    <label class="checkbox-bootstrap checkbox-lg">                           
                    <?php echo('<input id="seenCheckBox" name="'.$movie->id.'" type="checkbox"'. (($movie->viewed) ? 'checked' : '') . '>')?>           
                    <span class="checkbox-placeholder"></span>           
                    Seen
                    </label>
                </div>

                <form id="smileys">
                    <input id="radioSmileys" type="radio" name="<?php echo($movie->id)?>" value="1" class="sad"
                    <?php
                    if($movie->personalRating == 1)
                    {
                        echo 'checked="checked"';
                    }
                    ?>
                    >
                    <input id="radioSmileys" type="radio" name="<?php echo($movie->id)?>" value="2" class="neutral"
                    <?php
                    if($movie->personalRating == 2)
                    {
                        echo 'checked="checked"';
                    }
                    ?>
                    >
                    <input id="radioSmileys" type="radio" name="<?php echo($movie->id)?>" value="3" class="happy" 
                    <?php
                    if($movie->personalRating == 3)
                    {
                        echo 'checked="checked"';
                    }
                    ?>
                    >
                </form>
                
                <a class="float-right" href="http://www.imdb.com/title/<?php echo($movie->imdbId)?>" target="_blank">
                    <img src="/content/img/imdb.png" style="height:100px;">
                </a>

        </div>
      </div>
    </div>
  </div>
</div>
<br>

<!--COMMENTSECTION-->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<div class="container">
	<h2 class="text-center">Comments</h2>
	
    <ul id="posts">
    <?php
    $posts = $movie->posts;
    if(!$posts)
    {
        echo('<h3 class="text-center">No comments yet, be the first to leave a comment!</h3>');
    }
    foreach($posts as $post)
    {
        $userPost = User::withId($post->userId);
        echo
        ('
        <li class="card" id="post-'.$post->id.'">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                    <p class="text-secondary text-center">'.
                    gmdate("d-m-Y\<\b\\r\>H:i", strtotime($post->created)+($ms)).'</p>
                </div>
                <div class="col-md-10">
                    <p>
                        <a class="float-left" href="#"><strong>'. $userPost->FirstName.' '. $userPost->LastName.' </strong></a>
                        '.(($post->rating != 0) ?
                        '<div class="float-right">
                            <img src="/content/img/rating/'.$post->rating.'.svg" width="30" height="30">
                        </div>' : '').'

                   </p>
                   <div class="clearfix"></div>
                    <p>'.$post->content.'</p>
                    <p>
                    '. (($userPost->Id == $_SESSION['UID']) ? '<a class="float-right btn text-white btn-danger deleteButton" name="'.$post->id.'">Delete</a>' : '') . '
                   </p>
                </div>
            </div>            
        </div>
        </li>

        ');
    }
    ?>
    </ul>
</div>
    <div class="container">
        
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="text-center card-title">Leave a comment:</h2>
                <div class="card-block">
                    <textarea class="form-control" name="<?php echo($movie->id) ?>" placeholder = "Share your thoughts here..." id ="comment"></textarea>
                </div>
                <br>
                <div class="card-block">
                        <button class="btn btn-primary float-right" type="button" id="submitButton">Share</button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include VIEW . 'footer.php';?>

<script src="/content/scripts/script.js"></script>