<?php
    $u = new User();
    $users = $u->getAllUsers($db);
?>
<?php
if(isSession() && $_SESSION['user']->role_id === '2'):
?>
<div class="container">
    <div class="row showUser">
        <table class="table mt-5">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $flag = 0;
                foreach ($users as $user):
                    $flag++;
            ?>
            <tr>
                <th scope="row"><?= $flag ?></th>
                <td><?= $user->name ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->email ?></td>
                <td><button type="button" class="btn btn-danger deleteUser" data-id="<?= $user->id?>">Delete</button></td>
                <td><button type="button" class="btn btn-primary updateUser" data-id="<?= $user->id?>">Update</button></td>
            </tr>
            <?php
                endforeach;
            ?>
            </tbody>
        </table>
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