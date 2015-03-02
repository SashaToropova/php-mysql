<?php

require 'database.php';

if (!empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $priceError = null;
    $dateError = null;
    $countError = null;
    $contentError = null;
    // keep track post values
    $name = $_POST['name'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $count = $_POST['count'];

    $content = $_POST['content'];



    // validate input
    $valid = true;
    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($price)) {
        $priceError = 'Please enter Price';
        $valid = false;
    }

    if (empty($date)) {
        $dateError = 'Please enter date of manufacture';
        $valid = false;
    }

    if (empty($count)) {
        $countError = 'Please enter number of products';
        $valid = false;
    }
    if (empty($content)) {
        $countError = 'Please enter number of products';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO products (name,price,date,count,content) values(?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name,$price,$date,$count, $content));
        Database::disconnect();
        header("Location: index.php");
    }
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
            <h3>Create a Customer</h3>
        </div>

        <form class="form-horizontal" action="create.php" method="post">
            <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                <label class="control-label">Name</label>
                <div class="controls">
                    <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                <label class="control-label">Price</label>
                <div class="controls">
                    <input name="price" type="text" placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
                    <?php if (!empty($priceError)): ?>
                        <span class="help-inline"><?php echo $priceError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                <label class="control-label">Date</label>
                <div class="controls">
                    <input name="date" type="datetime"  placeholder="Date" value="<?php echo !empty($date)?$date:'';?>">
                    <?php if (!empty($dateError)): ?>
                        <span class="help-inline"><?php echo $dateError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($countError)?'error':'';?>">
                <label class="control-label">Count</label>
                <div class="controls">
                    <input name="count" type="text"  placeholder="Count" value="<?php echo !empty($count)?$count:'';?>">
                    <?php if (!empty($countError)): ?>
                        <span class="help-inline"><?php echo $countError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($contentError)?'error':'';?>">
                <label class="control-label">Content</label>
                <div class="controls">
                    <input name="content" type="file"  placeholder="Content" value="<?php echo !empty($content)?$content:'';?>">
                    <?php if (!empty($contentError)): ?>
                        <span class="help-inline"><?php echo $contentError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Create</button>
                <a class="btn" href="index.php">Back</a>
            </div>
        </form>
    </div>

</div> <!-- /container -->
</body>
</html>

