
<?php 
  $query = "SELECT * FROM orders LEFT JOIN products ON productid = id WHERE userid = {$_SESSION['uid']}";
  require_once DATABASE_CONTROLLER;
  $products = getList($query);
?>
<?php if(count($products) <= 0) : ?>
    <h1>No orders found in the database.</h1>
  <?php else : ?>
    <table class="table table-striped" align="left">
      <thead>
        <tr>
          <th scope="col">OrderId</th>
          <th scope="col">Product Name</th>
          <th scope="col">Type</th>
          <th scope="col">Price</th>
          <th scope="col">Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p) : ?>
            <tr>
              <td>
                <?=$p['orderid']?>
              </td>
              <td>
                <?=$p['name']?>
              </td>
              <td>
                <?=$p['type']?>
              </td>
              <td>
                <?=$p['amount']*$p['price']?>
              </td>
              <td>
                <?=$p['amount']?>
              </td>
            </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  <?php endif; ?>