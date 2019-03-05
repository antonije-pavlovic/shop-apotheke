<?php
if(isSession() && $_SESSION['user']->role_id === '2'):
?>

<div class="container">
    <div class="row">
        <form>
            <div class="form-group">
                <label>Brand name</label>
                <input type="text" class="form-control" id="brand" placeholder="Enter brand name">
            </div>
            <a type="button" class="btn btn-primary mt-5 addBrand">Submit</a>
        </form>
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