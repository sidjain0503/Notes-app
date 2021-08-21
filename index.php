<!doctype html>
<!-- INSERT INTO `notes` ( `title`, `description`) VALUES ( 'aman', 'speaker')"; -->
<?php
    $insert= false;
    $update= false;
    $delete = false;
        //making a connection
        $servername= "localhost";
        $username ="root";
        $passoword ="";
        $database = "Notes";

        $conn= mysqli_connect($servername,$username,$passoword,$database);
        
        if(!$conn){
          die("this connection was not established due to :". mysqli_connect_error());
      }
          
          if(isset($_GET['delete'])){
            $sno = $_GET['delete'];
            $delete = true;
            $sql ="DELETE FROM `notes` WHERE `sno`= $sno";
            $result = mysqli_query($conn,$sql);
          }
    
      if ($_SERVER['REQUEST_METHOD']== "POST"){
        if(isset( $_POST['snoEdit'])){
          $title =$_POST['titleEdit'];
          $description =$_POST['descEdit'];
          $sno =$_POST['snoEdit'];

          $sql = "UPDATE `notes` SET `title` = '$title' , `description`= '$description' WHERE `notes`.`Sno` = $sno";
       $result=mysqli_query($conn,$sql);
       if($result){
        $update = true;
    }
    else{
        echo "The database cannot be updated <br>". mysqli_error($conn);
    }
        }
        else{
        $title =$_POST['title'];
        $description =$_POST['desc'];


        //sql to be executed
        
       $sql = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$description')";
       $result=mysqli_query($conn,$sql);

       if($result){
        $insert = true;
    }
    else{
        echo "Record cannot be submitted because <br>". mysqli_error($conn);
    }
  }
      }

        ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
} );
      </script>

    <title>php_CRUD-INOTES</title>
  </head>
  <body>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

<!--Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <form action="/sidjain/CRUD-app/index.php" method="post"> 
      <div class="modal-body">
        <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
             
            </div>
            <div class="mb-3">
                <label for="textarea">Note Description</label>
              <textarea name="descEdit"  class="form-control" id="descEdit" cols="30" rows="3"></textarea>
            </div>
           
            
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
          </form>
      
     
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">PHP_CRUD_TODO-LIST</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact us </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <?php
      if($insert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Note  added!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($update){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> your note has been updated successfully !
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      if($delete){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> your note has been deleted succesfully 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      ?>
    <div class="container my-3">
    

      <!-- Form starts here  -->
        <form action="/sidjain/CRUD-app/index.php" method="post"> 
            <h2>Add a NOTE</h2>
            <div class="mb-3">
              <label for="title" class="form-label">Note Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
             
            </div>
            <div class="mb-3">
                <label for="textarea">Note Description</label>
              <textarea name="desc"  class="form-control" id="textarea" cols="30" rows="3"></textarea>
            </div>
           
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        <hr>
<div class="container ">
<table class="table " id="myTable">
  <thead>
    <tr>
      <th scope="col">SNo.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
  
      $sql= "SELECT * FROM `notes`";
      $result = mysqli_query($conn, $sql);
      $sno = 1;
      while($row= mysqli_fetch_assoc($result)){
        echo "<tr>
        <th scope='row'>". $sno . "</th>
        <td>". $row['title'] . "</td>
        <td>". $row['description'] . "</td>
        <td>
          <button class='btn btn-sm btn-primary edit' data-bs-toggle='modal' data-bs-target='#editModal' id=". $row['Sno'] .">Edit</button>
          <button class='btn btn-sm btn-primary delete'' id=d". $row['Sno'] .">Delete</button>
         </td>
      </tr>";
          $sno = $sno+1;
          }
          
          
      ?>
   
  </tbody>
</table>

</div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
   ]

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
  edits =document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{
    element.addEventListener('click',(e)=>{
      console.log("edit", );
      tr=e.target.parentNode.parentNode;
      title = tr.getElementsByTagName("td")[0].innerText;
      description= tr.getElementsByTagName("td")[1].innerText;
      console.log(title,description);
      snoEdit.value = e.target.id;
      titleEdit.value = title;
      descEdit.value = description;
     console.log(e.target.id);      
    
    })
  })

  deletes =document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{
    element.addEventListener('click',(e)=>{
     tr=e.target.parentNode.parentNode;
     sno= e.target.id.substr(1,);

      if(confirm("press ok ! if you want to delete Note!")){
        console.log("yes");
        window.location= `/sidjain/CRUD-app/index.php?delete=${sno}`;
        //make a form and submit post it .
      }      
      else{
        console.log("no");
      }
    
    })
  })
</script>
    
          
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>