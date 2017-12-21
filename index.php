<?php
require_once('conn.php');
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body id="body" class="">
    <header>
      <h1><a href="index.php">생활코딩 Javascript</a></h1>
    </header>
    <nav>
      <ol>
<?php
$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
  echo '<li><a href="/practice1/index.php?id='.htmlspecialchars($row['id']).'">'.htmlspecialchars($row['title']).'</a></li>';
}
 ?>
      </ol>
    </nav>
    <div id="content">
      <article>
<?php
if(empty($_GET['id'])){
  echo "Welcome";
}else{
  $id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT topic.id, topic.title, topic.description, topic.created, user.name FROM topic LEFT JOIN user ON topic.author = user.id WHERE topic.id=".$id;
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
?>
      <h2><?=htmlspecialchars($row['title'])?></h2>
        <div><?=htmlspecialchars($row['created'])?> | <?=htmlspecialchars($row['name'])?></div><br/>
        <div><?=strip_tags($row['description'], '<p>, <br>, <sup>, <a>')?></div>
<?php
}
 ?>
        </article>
        <input type="button" name="name" value="White" onclick="document.getElementById('body').className=''">
        <input type="button" name="name" value="black" onclick="document.getElementById('body').className='black'">
        <a href="write.php">쓰기</a>
      </div>
  </body>
</html>
