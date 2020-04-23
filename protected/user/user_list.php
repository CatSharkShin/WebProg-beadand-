<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
  <h1>Page access is forbidden!</h1>
<?php else : ?>
<center style="font-weight: bold;color: green">
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['delete'])){
      if(!delUser($_POST['id'])){
        echo "Sikertelen törlés";
      }else{
        echo "Sikeres törlés";
      }
    }else if(isset($_POST['save'])){
      $postData = [
      	'id' => $_POST['id'],
		'fname' => $_POST['first_name'],
		'lname' => $_POST['last_name'],
		'email' => $_POST['email'],
		'permission' => $_POST['permission']
	];

	if(empty($postData['fname']) || empty($postData['lname']) || empty($postData['email'])) {
		echo "Missing information!";
	} else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
		echo "Wrong email format!";
	}else if($postData['permission'] < 0 || $postData['permission'] > 1){
		echo "Incorrect permission level!";
	}else if(!userEdit($postData['id'],$postData['fname'], $postData['lname'], $postData['email'], $postData['permission'])) {
		echo "Edit failed!";
	}

	$postData['password'] = $postData['password1'] = "";

    }
  }
 ?></center>

<?php 

  $query = "SELECT id,first_name, last_name, email, permission FROM users";
	require_once DATABASE_CONTROLLER;
  $users = getList($query);
?>
<?php if(count($users) <= 0) : ?>
    <h1>No users found in the database.</h1>
  <?php else : ?>
    <table class="table table-striped" align="left">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Permission</th>
          <th scope="col">Save</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u) : ?>
          <form method="post">
            <tr>
              <td scope="row"><input type="hidden" name="id" value="<?=$u['id']?>"><?=$u['id']?></td>

              <td><input class="form-control" type="text" name="first_name" value="<?=$u['first_name'] ?>"></td>

              <td><input class="form-control" type="text" name="last_name" value="<?=$u['last_name'] ?>"></td>

              <td><input class="form-control" type="email" name="email" value="<?=$u['email'] ?>"></td>

              <td><input min="0" max="1" class="form-control" type="number" name="permission" value="<?=$u['permission'] ?>"></td>

              <td><input type="submit" name="save" value="Save" class="btn btn-primary"></td>

              <td><input type="submit" name="delete" value="Delete" class="btn btn-primary"></td>
            </tr>
          </form>
        <?php endforeach;?>
      </tbody>
    </table>
  <?php endif; ?>
  <style type="text/css">
    table{
      table-layout: auto;
    }
  </style>
  <?php endif; ?>