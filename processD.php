<?php
//데이터베이스 접속
$conn = mysqli_connect('localhost', 'root', '111111');
mysqli_select_db($conn, 'tutorials2');
//user테이블의 name에 있는지 유무를 확인 후 없다면 user테이블에 name를 추가함.
$author = mysqli_real_escape_string($conn, $_POST['author']);
$sql = "SELECT * FROM `user` WHERE name ='{$author}'";
$result = mysqli_query($conn, $sql);
if($result -> num_rows > 0){
  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];
}else{
  $sql = "INSERT INTO `user` (`name`) VALUES ('{$author}')";
  mysqli_query($conn, $sql);
  $user_id = mysqli_insert_id($conn);
}
$topic_id = mysqli_real_escape_string($conn, $_POST['topic_id']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$sql = "INSERT INTO `topic` (`id`, `title`, `description`, `author`, `created`) VALUES ('{$topic_id}', '{$title}', '{$description}', '{$user_id}', now())";
mysqli_query($conn, $sql);
header('Location:index.php');
 ?>
