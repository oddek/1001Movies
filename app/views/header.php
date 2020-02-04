<?php
	$action = $this->getAction();

  $user = null;
  if(isset($_SESSION['UID']))
  {
    $user = User::withId($_SESSION['UID']);
  }
  
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
  <a class="navbar-brand" href="/home/index">
    <img src="/content/img/logo.svg" width="30" height="30" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($action == 'index' ? 'active' : '');?>">
        <a class="nav-link" href="/home/index">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/home/movies">Movies</a>
      </li>

      <!--Status-->
      <li class="nav-item <?php echo ($action == 'aboutUs' ? 'active' : '');?>">
        <a class="nav-link" href="/home/progress" tabindex="-1" aria-disabled="true">Progress</a>
      </li>

      <!--About US-->
      <li class="nav-item <?php echo ($action == 'aboutUs' ? 'active' : '');?>">
        <a class="nav-link" href="/home/aboutUs" tabindex="-1" aria-disabled="true">About</a>
      </li>

      <!--ADMIN-->
      <?php
      if($user != null && $user->IsAdmin)
        {
          echo('
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/admin/viewUsers">Brukere</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>



            ');
        }
        ?>
    </ul>
      <!--PROFILE-->
      <div class ="navbar-nav">
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo (($user != null) ? "$user->LastName, $user->FirstName" : "") ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/home/profile">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/login/logout">Logout</a>
          </div>
        </div>
      </div>
  </div>
</div>
</nav>

<div class="container" style= "height:100vh">