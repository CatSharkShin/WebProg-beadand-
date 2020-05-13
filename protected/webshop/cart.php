<?php
  require_once DATABASE_CONTROLLER;
  if(!empty($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    $query = "SELECT id,type,name,price,image FROM products WHERE id IN (";
    foreach($cart as $key => $item){
        $query .= "'{$key}',";
    } //note: thought "foreach(array_keys($array) as $key)" would be faster, but its slower
    $query[strlen($query)-1] = ')';
    $query .= ";";
    $items = getList($query);
    $price = 0;
    foreach($items as $item){
      $price += $item['price']*$cart[$item['id']];
    }
  }else
    echo "Your cart is empty! You better fill it up ASAP!";

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order']) && IsUserLoggedIn()){
    foreach($items as $item){
      $stmt = "INSERT INTO orders(productid,amount,userid) VALUES ( :productid, :amount, :userid); SELECT LAST_INSERT_ID();";
      $params = [
        ':productid' => $item['id'],
        ':amount' => $cart[$item['id']],
        ':userid' => $_SESSION['uid']
      ];
      if(!executeDML($stmt,$params))
        header("Location: index.php?P=orderresult&result=fail");
      else{
        $_SESSION['cart'] = array();
        header("Location: index.php?P=orderresult&result=success");
      }
    }
  }
    
 ?>
  <?php if(!empty($_SESSION['cart'])): ?>
    <h1>Cart:</h1>

    <?php echo "Overall price: ".$price; ?>
    <br>
    <strong>Items: </strong>
    <?php foreach($items as $item): ?>
      <div>
        <?=$item['name']?>(<?=$cart[$item['id']]?>): <?=$item['price']*$cart[$item['id']]."Ft"?>
      </div>
    <?php endforeach ?>
    <?php if(!IsUserLoggedIn()): ?>
      <strong>Login to be able to order</strong>
    <?php else: ?>
      <form method="post">
        <button class="btn btn-success" type="submit" name="order">Order</button>
      </form>
  <?php endif; ?>
<?php endif; ?>