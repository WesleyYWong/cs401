<?php
session_start();
echo print_r($_SESSION,1);
?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="comments.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/comments.js" type="text/javascript"></script>
  </head>
  <body>
    <h1>Leave a comment</h1>
    <form action="comment_handler.php" method="post">
      <div><label for="email">What's your age?</div>
      <input value="<?php echo $_SESSION['form_data']['age']; ?>" type="text" name="age">
      <div>Leave a comment</div>
      <input value="<?php echo $_SESSION['form_data']['comment'] ?>" type="text" name="comment">
      <input type="submit">
    </form>
    <?php
    if (isset($_SESSION['messages'])) {
       foreach ($_SESSION['messages'] as $message) {
         echo "<div class='message {$_SESSION['sentiment']}'>{$message}<span class='close'>x</span></div>";
       }
    }

    ?>
    <?php
       require_once 'Dao.php';
       $dao = new Dao();
       $comments = $dao->getComments();
       echo "<table>";
       foreach($comments as $comment) {
         echo "<tr><td>" . htmlspecialchars($comment['comment']) . "</td>" .
           "<td>{$comment['date_entered']}" .
           "<td><a href='delete_handler.php?comment_id={$comment['comment_id']}'>X</a></td></tr></tr>";
       }
         echo "</table>";
    ?>
  </body>
</html>
