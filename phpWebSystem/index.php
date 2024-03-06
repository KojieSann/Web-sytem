<?php
    $db = mysqli_connect('localhost', 'root','','websystem');
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
<div class="planet-container">
  <div id="mercury" class="planet">
    <div class="planet__body">
      <div class="star"></div>
      <div class="star"></div>
      <div class="star"></div>
      <div class="star"></div>
      <div class="star"></div>
      <div class="star"></div>
    </div>
  </div>
  <div id="venus" class="planet">
    <div class="planet__body"></div>
  </div>
  <div id="earth" class="planet">
    <div class="planet__body">
      <div class="land"></div>
      <div class="land"></div>
      <div class="cloud"></div>
    </div>
  </div>
  <div id="jupiter" class="planet">
    <div class="planet__body">
    </div>
  </div>
</div>
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
                    <input type="text" required class="firstname" name="firstName"/>
                    <span>Firstname</span>
                    </div>
                    <div class="input-box">
                    <input type="text" required class="lastname" name="lastName"/>
                    <span>Lastname</span>
                    </div>
                </div>
                <button class="slide" name= "submit">Submit</button>
        </form>
    </div>
</div>
<div class="table-content">
    <button class="modal-button" rel="grow"><i class="fa-solid fa-plus"></i> Add new</button>
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
                        <a href="edit.php?id=<?php echo $id;?> "><i class="fa fa-solid fa-pencil"></i></a>
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
<div class="stars"></div>
<script src="./script.js"></script>
</body>
</html>
<?php
    if (isset($_POST ['submit'])){
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $sql = "insert into crud values(null, '$firstName','$lastName')";
        if (mysqli_query($db,$sql)){
            echo '<script>alert("Data inserted to table successfully");</script>';
            header('location: ./index.php');

        }else{
            echo mysqli_error($db);
        }
    }
?>