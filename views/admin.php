<?php
    if(isSession() && $_SESSION['user']->role_id === '2'):
?>
    <div class="container">
       <div class="row m-3">
           <div class="col-lg-6">
               <span class="ml-3">Users: </span></br>
               <a href="index.php?page=addUser" class="btn btn-primary my-2 my-sm-0 ml-3 addNewUSer">Add new user</a>
               <a href="index.php?page=update" class="btn btn-primary my-2 my-sm-0 ml-3">Update or delete user</a>
           </div>
           <div class="col-lg-6">
               <span class="ml-3"> Products: </span></br>
               <a href="index.php?page=addProduct" class="btn btn-primary my-2 my-sm-0 ml-3 addProduct">Add new product</a>
               <a href="index.php?page=updateProduct" class="btn btn-primary my-2 my-sm-0 ml-3">Update or delete product</a>
           </div>
       </div>
        <div class="row adminContent">

        </div>
    </div>
<?php
    else:
?>
<div class="container my-5">
   <img src="public/images/admin.jpg" alt="blaa">
</div>
<?php
    endif;
?>