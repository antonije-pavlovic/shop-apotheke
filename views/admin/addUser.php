<?php
if(isSession() && $_SESSION['user']->role_id === '2'):
?>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-lg-6">
            <form>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="email" class="form-control" id="name" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input type="email" class="form-control" id="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <label >Active or not:</label>
                <select class="form-control" id="active">
                    <option value="0" >Non-active</option>
                    <option value="1">Active</option>
                </select>
                <label class="mt-2">Choose role:</label>
                <select class="form-control" id="role">
                    <option value="1">User</option>
                    <option value="2">Admin</option>
                </select>
                <a type="button" class="btn btn-primary mt-5 addUserAdmin text-white">Submit</a>
            </form>
        </div>
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