<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
  <h1>Page access is forbidden!</h1>
<?php else : ?>
<center style="font-weight: bold;color: green">
<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['add'])){

      if(!isset($_POST['type']) || !isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['image'])){
        echo "All fields must be filled!";
      }else{
        $postData = [
          'type' => $_POST['type'],
          'name' => $_POST['name'],
          'price' => $_POST['price'],
          'image' => $_POST['image'],
        ];
        if($postData['price'] < 0)
          echo "The price has to be a positive number!";
        else if(!addProduct($postData['type'],$postData['name'],$postData['price'],$postData['image'])){
          echo "Whoopsie Daisy, that didn't work as expected. Try again!";
        }else
          echo "It worked! You just added a product.";
      }
    }else if(isset($_POST['delete'])){
        if(!delProduct($_POST['id'])){
          echo "Delete failed";
        }else{
          echo "Delete successful";
        }
    }
    else if(isset($_POST['save'])){
      if(!isset($_POST['type']) || !isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['image']) || !isset($_POST['id'])){
        echo "All fields must be filled!";
      }
      $postData = [
        'type' => $_POST['type'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'id' => $_POST['id']
      ];
      if(empty($postData['name']) || empty($postData['type']) || empty($postData['image']) || empty($postData['price'])){
        echo "All fields must be filled!";
      }else if(!editProduct($postData['id'],$postData['type'],$postData['name'],$postData['price'],$postData['image'])){
        echo "Edit failed";
      }else{
        echo "Edit successful";
      }
    }
  }
 ?></center>

<form style="margin-bottom: 30px;" method="POST">
  <div class="form-row justify-content-center">

    <div class="col-md-4-auto mb-3">
      <label for="validationCustom04">Type</label>
      <select class="custom-select" name="type" required>
        <option selected disabled value="">Choose...</option>
        <option value="2x2">2x2</option>
        <option value="3x3">3x3</option>
        <option value="4x4">4x4</option>
      </select>
    </div>
    <div class="col-md-4-auto mb-3">
      <label for="validationCustom01">Product Name</label>
      <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Wowcube 2000" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4-auto mb-3">
      <label for="validationCustom02">Image Name</label>
      <input type="text" class="form-control" name="image" id="validationCustom02" placeholder="wowcube" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4-auto mb-3">
      <label for="validationPrice">Price</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">Ft</span>
        </div>
        <input type="number" placeholder="2 000" name="price" class="form-control" id="validationPrice" aria-describedby="inputGroupPrepend" required>
      </div>
    </div>
        <button class="btn btn-primary" name="add" type="submit">Add Product</button>
  </div>
</form>

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
          <th scope="col">#</th>
          <th scope="col">Product Name</th>
          <th scope="col">Type</th>
          <th scope="col">Image Name</th>
          <th scope="col">Price</th>
          <th scope="col">Save</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p) : ?>
          <form method="post">
            <tr>
              <td scope="row"><input type="hidden" name="id" value="<?=$p['id']?>" required><?=$p['id']?></td>

              <td><input class="form-control" type="text" name="name" value="<?=$p['name'] ?>"></td>

              <td>
                <select class="custom-select" name="type">
                  <option selected value="<?=$p['type']?>"><?=$p['type']?></option>
                  <option value="2x2">2x2</option>
                  <option value="3x3">3x3</option>
                  <option value="4x4">4x4</option>
                </select>
              </td>

              <td><input class="form-control" type="text" name="image" value="<?=$p['image'] ?>"></td>

              <td><input class="form-control" type="number" name="price" value="<?=$p['price'] ?>"></td>
              <td><input type="submit" name="save" value="Save" class="btn btn-primary"></td>
              <td><input type="submit" name="delete" value="Delete" class="btn btn-danger"></td>
            </tr>
          </form>
        <?php endforeach;?>
      </tbody>
    </table>
    <center><strong>You cannot delete products that are being ordered</strong></center>
  <?php endif; ?>
  <style type="text/css">
    table{
      table-layout: auto;
    }
  </style>
  <?php endif; ?>