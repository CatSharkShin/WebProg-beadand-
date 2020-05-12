<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
  <h1>Page access is forbidden!</h1>
<?php else : ?>
<center style="font-weight: bold;color: green">
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['delete'])){
      require_once DATABASE_CONTROLLER;
      $query = "DELETE FROM orders WHERE orderid = :orderid";
      $params = [ ':orderid' => $_POST['orderid']];
      if(!executeDML($query,$params)){
        echo "Delete failed";
      }else{
        echo "Delete was successful";
      }
    }else if(isset($_POST['save'])){
      if(empty($_POST['amount'])){
          echo "Amount field must not be empty";
      }else{
        require_once DATABASE_CONTROLLER;
        $query = "UPDATE orders SET amount = :amount WHERE orderid = :orderid";
        $params = [ ':amount' => $_POST['amount'],
                    ':orderid' => $_POST['orderid']
      ];
        if(!executeDML($query,$params)){
          echo "Update failed";
        }else{
          echo "Update was successful";
        }
      }
    }
  }
 ?></center>
<?php 
  $query = "SELECT * FROM orders LEFT JOIN products ON productid = id";
  require_once DATABASE_CONTROLLER;
  $products = getList($query);
?>
<?php if(count($products) <= 0) : ?>
    <h1>No products found in the database.</h1>
  <?php else : ?>
    <table class="table table-striped" align="left">
      <thead>
        <tr>
          <th scope="col">OrderId</th>
          <th scope="col">User</th>
          <th scope="col">Product Name</th>
          <th scope="col">Type</th>
          <th scope="col">Price</th>
          <th scope="col">Amount</th>
          <th scope="col">Save</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p) : ?>
            <tr>
              <form method="post">
                <td>
                  <input type="hidden" name="orderid" value="<?=$p['orderid']?>">
                  <?=$p['orderid']?>
                </td>
                <td>
                  <?=$p['userid']?>
                </td>
                <td>
                  <?=$p['name']?>
                </td>
                <td>
                  <?=$p['type']?>
                </td>
                <td>
                  <?=$p['price']?>
                </td>
                <td>
                  <input class="form-control" type="number" name="amount" value="<?=$p['amount']?>">
                </td>

                <td><input type="submit" name="save" value="Save" class="btn btn-primary"></td>

                <td><input type="submit" name="delete" value="Delete" class="btn btn-danger"></td>
              </form>
            </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  <?php endif; ?>
  <?php endif; ?>