<?php
require_once (__DIR__ . '../../bootstrap.php');
SessionChecker::checkSession();

if (!isset($_GET['page'])) {
    SessionChecker::redirectWithMsg('Błędny adres strony.');
}

?>

<table class="table-style-two">
   <tr>
       <td>
           <form action="" method="POST" role="form">
               <div class="form-group commentForm">
                   <div class="form-group">
                       <textarea class="form-control" rows="4" name="commentContent" id="commentContent" placeholder="Dodaj komentarz..."></textarea>
                   </div>
                   <input type="hidden" name="tweetId" value="<?php echo $val->getId(); ?>">
                   <div class="text-right">
                   <button type="submit" name="submit" value="add" class="btn btn-warning submitButton2">Dodaj komentarz</button>
                   </div>
               </div>
           </form>
       </td>
   </tr>
</table>
