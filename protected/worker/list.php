<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
<?php 
	$query = "SELECT first_name, last_name, email, gender, nationality FROM workers";
	require_once DATABASE_CONTROLLER;
	$workers = getList($query);
?>
	<?php if(count($workers) <= 0) : ?>
		<h1>No wokers found in the database</h1>
	<?php else : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Gender</th>
					<th scope="col">Nationality</th>
					<th scope="col">Szerkesztés</th>
					<th scope="col">Törlés</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($workers as $w) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><?=$w['first_name'] ?></td>
						<td><?=$w['last_name'] ?></td>
						<td><?=$w['email'] ?></td>
						<td><?=$w['gender'] == 0 ? 'Female' : ($w['gender'] == 1 ? 'Male' : 'Other') ?></td>
						<td><?=$w['nationality'] ?></td>
						<td><a href="#">Edit</a></td>
						<td><a href="#">Delete</a></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>