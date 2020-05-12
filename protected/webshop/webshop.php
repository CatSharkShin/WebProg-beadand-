<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['add']){
      if(!isset($_POST['id']) || !isset($_POST['amount']))
        echo "Something went wrong. Please try again";
      if(!isset($_SESSION['cart']))
        $_SESSION['cart'] = array();
      if(isset($_SESSION['cart'][$_POST['id']])){
        $_SESSION['cart'][$_POST['id']] += $_POST['amount'];
      }else{
          $_SESSION['cart'][$_POST['id']] = $_POST['amount'];
          echo "Product added";
      }

    }
  }
 ?>

<?php 
  $query = "SELECT image,id, name, type, price FROM products";
  require_once DATABASE_CONTROLLER;
  $products = getList($query);
?>
<?php if(count($products) <= 0) : ?>
    <h1>No products found in the database.</h1>
  <?php else : ?>


    <table class="table table-striped" align="left">
      <thead>
        <tr>
          <th scope="col">Product Name</th>
          <th scope="col">Type</th>
          <th scope="col">Image</th>
          <th scope="col">Price</th>
          <th scope="col">Amount</th>
          <th scope="col">Add</th>
        </tr>
      </thead>
      <tbody>


        <?php foreach ($products as $p) : ?>
          <form method="post">
            <input type="hidden" name="id" value="<?=$p['id']?>">
            <tr>
              <td>
                <strong><?=$p['name']?></strong>
              </td>
              <td>
                <strong><?=$p['type']?></strong>
              </td>
              <td>
                <strong><img style="max-height: 50px;" src="<?=IMAGES.$p['image'].".png"?>" alt="Nincs megadott kép"></strong>
              </td>
              <td>
                <strong><?=$p['price']?></strong>
              </td>
              <td>
                <input class="form-control" type="number" min="1" name="amount" value="1">
              </td>
              <td>
                <input type="submit" name="add" value="Add to Cart" class="btn btn-success">
              </td>
            </tr>
          </form>

        <?php endforeach;?>
      </tbody>
    </table>
  <?php endif; ?>