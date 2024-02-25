<?php 

//Create connetion
require_once("connection.php") ;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $strRemove = $pdo->prepare("DELETE FROM  product where product_id=:id");
    $id= $_REQUEST["id"];
    $strRemove->bindValue(':id',$id);
    $strRemove->execute();
    header("Location:index.php");
    exit();
}
$id=$_REQUEST["id"];
//Prepare Statement
$statement = $pdo->prepare("SELECT * FROM product WHERE product_id=:id");

//Bind value
$statement-> bindValue(":id",$id);
//Excate
$statement->execute();
//Get Data
$proDoc=$statement-> fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <h1>Delete Form</h1>
    Product Name:<?php echo $proDoc ['name']?> <br>
    Price :<?php echo $proDoc ['price']?> <br>
    Note :<?php echo $proDoc ['note']?> <br>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $proDoc ['product_id'];?>"/>
        <input class="btn btn-danger" type="submit"name="" id="" value="Confirm Delete"/>
</form> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

