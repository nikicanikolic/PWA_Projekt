<?php 
include'connect.php';

$picture= $_FILES['pphoto']['name'];
$title=$_POST['title'];
$about=$_POST['about'];
$content=$_POST['content'];
$category=$_POST['category'];
$date=date('d.m.Y.');

if(isset($_POST['archive']))
{
  $archive=1;
}
  else
{
  $archive=0;
}

$target_dir= '../resources/images/'.$picture;
move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);


$query= "INSERT INTO articles (dateOfCreation, title, about, content, picture, category, archive) VALUES('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";
$result= mysqli_query($dbc, $query) or die('Error querying databese.');

if($result == TRUE){
  echo "A record has been inserted.";
} else {
  echo "Could not insert record.";
}

mysqli_close($dbc);
?>