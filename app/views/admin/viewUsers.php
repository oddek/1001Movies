<?php 
	 include VIEW . 'head.php';
	 include VIEW . 'header.php';
?>
<h1 class="my-4">Users</h1>
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Admin</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach ($this->view_data as $user)
    {
    	echo('<tr id="user-'. $user->Id .'">
        <td>' . $user->FirstName . '</td>
        <td>' . $user->LastName . '</td>
        <td>' . $user->Email . '</td>
        <td>' . ($user->IsAdmin ? 
        '<span class="badge badge-success">Admin</span>' : 
       	'<span class="badge badge-danger">User</span>')
         . '</td>
         <td>
          <button type="button" name="'. $user->Id .'" user="'.$user->FirstName .' '. $user->LastName .'" class="btn btn-outline-danger btn-sm deleteUserButton">Delete</button></a>
         </td>
      </tr>');
    }
    ?>
    </tbody>
  </table>
</div>
<?php 
 ?>
<?php include VIEW . 'footer.php';?>
<script src="/content/scripts/script.js"></script>