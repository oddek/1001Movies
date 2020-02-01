<?php 
//Class for handling all the AJAX-calls.
class ajaxController extends Controller
{
  //Toggles wether a user has seen a movie or not
	public function post_toggleSeen($id='', $name='')
	{
		if (isset($_POST['id']) && isset($_POST['status'])) 
		{
    		$movieId = $_POST['id'];
  			$seen = filter_var ($_POST['status'], FILTER_VALIDATE_BOOLEAN);
  			var_dump($seen);
  			if($seen)
  			{
  				$this->core->sql->SetMovieAsViewed($movieId);
  			}
  			else
  			{
  				$this->core->sql->SetMovieAsNotViewed($movieId);
  			}
  		}
	}
  //Sets rating
  public function post_giveRating($id='', $name='')
  {
    if(isset($_POST['id']) && isset($_POST['rating']))
    {
      $movieId = $_POST['id'];
      $rating = $_POST['rating'];

      $this->core->sql->SetMovieAsViewed($movieId, $rating);
    }
  }

  //submit comment. Returns the comment in proper format, so that jquery can append the new post dynamically
  public function post_submitComment($id='', $name='')
  {
    if(isset($_POST['id']) && isset($_POST['content']))
    {
      $movieId = $_POST['id'];
      $content = $_POST['content'];

      $this->core->sql->add_post($movieId, $content);
      $userId = $_SESSION['UID'];
      $user = User::withId($userId);
      $query = "SELECT * FROM Posts WHERE MovieId = '$movieId' AND UserId = '$userId' AND Content = '$content'";

      $res = $this->core->sql->custom_query($query);

      if($res && $res->num_rows != 0)
      {
        $row = $res->fetch_assoc();
        $post = Post::withRow($row);

        echo
          '<li class="card" id="post-'.$post->id.'">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                        <p class="text-secondary text-center">'.
                    gmdate("d-m-Y\<\b\\r\>H:i", strtotime($post->created)+(60*60)).'</p>
                    </div>
                    <div class="col-md-10">
                        <p>
                            <a class="float-left" href="#"><strong>'. $user->FirstName.' '. $user->LastName.' </strong></a>
                            '.(($post->rating != 0) ?
                            '<div class="float-right">
                                <img src="/content/img/rating/'.$post->rating.'.svg" width="30" height="30">
                            </div>' : '').'

                       </p>
                       <div class="clearfix"></div>
                        <p>'.$post->content.'</p>
                        <p>
                        '. (($user->Id == $_SESSION['UID']) ? '<a class="float-right btn text-white btn-danger deleteButton" name="'.$post->id.'">Delete</a>' : '') . '
                       </p>
                    </div>
                </div>            
            </div>
            </li>';

      }
    }

  }
  
  //DeletePost
  public function post_deleteComment($id='', $name='')
  {
    if(isset($_POST['id']))
    {
      $postId = $_POST['id'];

      $this->core->sql->delete_row_where('posts', 'Id', $postId);
    }
  }
}