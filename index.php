
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body style='rgb(139, 139, 129);'>
<?php
 $connex=new PDO('mysql:host=localhost;dbname=projet', 'root', '');
if ((isset ($_POST['name_edit'])  && isset($_POST['email_edit']))&&(isset($_GET['edit'])&& isset($_GET['id']))){
  $id_edit=$_GET['id'];
  $name_edit=$_POST['name_edit'];
  $email_edit=$_POST['email_edit'];

 $connex->exec("update devoir SET name ='$name_edit', email = '$email_edit' WHERE id=$id_edit");
 }
  if(isset($_GET['id'])&&isset($_GET['delete'])){
  $id=$_GET['id'];
  $delete=$connex->exec("delete from devoir where id=$id");
}
if ((isset ($_POST['name_edit'])  && isset($_POST['email_edit']))&&(isset($_GET['edit'])&& isset($_GET['id']))){
  $id_edit=$_GET['id'];
  $name_edit=$_POST['name_edit'];
  $email_edit=$_POST['email_edit'];

 $connex->exec("update devoir SET name ='$name_edit', email = '$email_edit' WHERE id=$id_edit");
 }
?>
    <br>
    <div class="container">

  <div class="card mt-5">
    <div class="card-header" style="background-color: rgb(122, 17, 100);"> 
      <h2 style="text-align: center; color:white">All people</h2>
    </div>
    <div class="card-body" style="background-color: rgb(251, 253, 106);">
    <form method="post">
    <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input  class="form-control" id=""name="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
 <?php
 if (isset ($_POST['name'])  && isset($_POST['email'])){
 $name=$_POST['name'];
 $email=$_POST['email'];
 $insert=$connex->exec("insert into devoir(name,email) values('$name','$email')");
}
 $query=$connex->query("select * from devoir");
 $data=$query->fetchAll(\PDO::FETCH_ASSOC);

 if(isset($_GET['edit'])&& isset($_GET['id'])){
  $id=$_GET['id'];
  $query=$connex->query("select * from devoir where id=$id");
  $data1=$query->fetchAll(\PDO::FETCH_ASSOC);
  $name=$data1[0]['name'];
  $email=$data1[0]['email'];
  echo "<form style='position:relative;top:15px;left:15px;' method='post'  ><input type='text' id='fname' value='$name' name='name_edit' placeholder='Enter name'><input type='text' id='lname' value='$email' name='email_edit'  placeholder='Enter email'> <input type='submit' >";
}
 echo '<br>';
 echo '<br>';

 $table="<table class='table table-dark'>
 <tr> 

   <th>email</th>
   <th>nom</th>
   <th>suprimer</th>
   <th>modifier</th>

 </tr>";
 for($i=1;$i<sizeof($data);$i++){
    $email=$data[$i]['email'];
    $name=$data[$i]['name'];
    $id=$data[$i]['id'];
     $table=$table."<tr><td>$email</td><td>$name</td><td><form action='index.php?id=$id&delete=2' method='post' ><button type='submit' class='btn btn-danger' id='submit' name='submit'>Delete</button></form></td><td><form action='index.php?edit=1&id=$id' method='post' ><button type='submit' class='btn btn-success' id='submit' name='submit'>Edit</button></form></td></tr>";
 } 
 $table=$table."</tbody></table>";
echo "<div>$table</div>";
?>
  </div>
    
</body>
</html>