<?php
    $db = mysqli_connect('localhost', 'root','','websystem');
    if (!$db){
        die('error in db' . mysqli_error($db));
    }
    else{
        $id = $_GET ['id'];
        $qry = "Select * from crud where id = $id";
            $run = $db -> query ($qry);
            if($run -> num_rows > 0){
                while($row = $run -> fetch_assoc()){
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                }
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="container">
    <div class="wrapper">
        <div class="close-modal">
        <i class="fa-solid fa-xmark"></i>
        </div> 
        <form action="" method="post">
                <div class="info">
                    <h1>CRUD Operations</h1>
                </div>
                <div class="input-container">
                    <div class="input-box">
                    <input type="text" required class="firstname" name="firstName" value="<?php echo $firstName;?>"/>
                    <span>Firstname</span>
                    </div>
                    <div class="input-box">
                    <input type="text" required class="lastname" name="lastName" value="<?php echo $lastName;?>"/>
                    <span>Lastname</span>
                    </div>
                </div>
                <button class="slide" name= "update" value="update">Update</button>
        </form>
    </div>
</div>
<div class="table-content">
    <button class="modal-button" rel="grow">Update</button>
    <div class="table-container">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        $qry = "select * from crud";
                        $run = $db -> query ($qry);
                        if ($run -> num_rows > 0){
                            while ($row = $run -> fetch_assoc()){
                                $id = $row ['id']
            
                    ?>
                  <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $row['firstName']?></td>
                    <td><?php echo $row['lastName']?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $id;?> "><i class="fa fa-solid fa-pencil edit"></i></a>
                        <a href="./delete.php?id=<?php echo $id;?>" onclick ="return confirm('sure ka????')"><i class="fa fa-solid fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php
                                        
                                    }
                                }
                  ?>
                </tbody>
              </table>
            </div>
</div>
<canvas id="canvas"></canvas>
<script src="./script.js"></script>
</body>
</html>
<?php
    if(isset($_POST ['update'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $qry = "update crud set firstName = '$firstName', lastName='$lastName' where id = $id";
        if(mysqli_query($db, $qry)){
            header('location: ./index.php');
        }else{
            echo mysqli_error($db);
        }
    }    

?>