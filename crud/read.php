<?php
require 'database.php';
$id = null;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if ( null==$id ) {
    header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM products where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Read a Product</h3>
        </div>

        <div class="form-horizontal" >
            <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['name'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['price'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Date</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['date'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Count</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['count'];?>
                    </label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Content</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo '<img src="img/'.$data['content'].'"/>';?>
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn" href="index.php">Back</a>
            </div>


        </div>
    </div>

</div> <!-- /container -->
</body>
</html>
