<?php 
require_once("connection.php");
// 1-Create Connection
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      echo var_dump($_FILES['imge']);
      $image =$_FILES['image']?? null;
      $imagePath= "";
      if ($image){
         $imagePath="image/" . $image['name'];
         move_uploaded_file($image['tmp_name'], $imagePath);

      }
    echo $_REQUEST['name'];
    echo $_REQUEST['id'];
    echo $_REQUEST['price'];
    echo $_REQUEST['note'];
    echo $_REQUEST['image']; 
      
      // 2-Prepare Statement
      $upSt = $pdo->prepare("UPDATE product set name = :name, price = :price, note = :note,image=:image WHERE product_id = :id");

      $upSt->bindValue(':id',$_REQUEST['id'] );
      $upSt->bindValue(':name', $_REQUEST['name']);
      $upSt->bindValue(':price', $_REQUEST['price']);
      $upSt->bindValue(':note',$_REQUEST['note']);
      $upSt->bindValue(':image',$imagePath);

      // 3-Execute
      $upSt->execute();

      header("Location: index.php");
      return false;
   }
$id=$_REQUEST["id"];
//Prepare Statement
$statement = $pdo->prepare("SELECT * FROM product WHERE product_id=:id");

//Bind value
$statement-> bindValue(':id',$id);
//Excate
$statement->execute();
//Get Data
$pro=$statement-> fetch(PDO::FETCH_ASSOC);

    
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
   <div class="container">
      <h1>Edit Product</h1>
      <form action="" method="post" enctype="multipart/form-data">
         <div class="mb-3 row">
            <label for="proName" class="form-label col-md-3">Product Name </label>
            <div class="col-md-9">
               <input type="text" id="proName" class="form-control" name="name" value ="<?php echo $pro['name']?>"/>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="proPrice" class="form-label col-md-3">Price </label>
            <div class="col-md-9">
               <input type="number" id="proPrice" class="form-control" name="price" value ="<?php echo $pro['price']?>" />
            </div>
         </div>
         <div class="mb-3 row">
            <label for="proNote" class="form-label col-md-3">Note </label>
            <div class="col-md-9">
               <input type="text" id="proNote" class="form-control" name="note" value ="<?php echo $pro['note']?>"/>
            </div>
         </div>
         <div class="mb-3 row">
            <label for="prophoto" class="form-label col-md-3">Photo</label>
            <div class="col-md-6">
               <input type="text" id="prophoto" class="form-control" name="image" value ="<?php echo $pro['image']?>"/>
            </div>
            <div class="col-md-3">
               <input type="file" id="prophoto" class="form-control" name="image" />
            </div>
         </div>
        
         <input type="hidden" name ="id" value ="<?php echo $pro['product_id']?>">
         <button class="btn btn-success" style="float:right;">Save</button>
      </form>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>