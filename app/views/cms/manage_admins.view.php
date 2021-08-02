<?php require_once APPROOT . '\views\inc\cms\header.inc.php'; ?>
<div class="main-page">
    <div class="main-content">
        <h1>Manage Admins</h1>
        <div>
           <?php flash ('user_message'); ?>
        </div>
        <div>
            <form action="<?= URLROOT ?>/cms/manage_admins" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control <?= (!empty ($data ['name_err'])) ? 'is-invalid' : '' ?>"
                        type="text" name="name" placeholder="Enter Your Name" value="<?= $data ['name'] ?>">
                        <span class="invalid-feedback"><?= $data ['name_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control <?= (!empty ($data ['email_err'])) ? 'is-invalid' : '' ?>"
                        type="text" name="email" placeholder="Enter Your Email" value="<?= $data ['email'] ?>">
                        <span class="invalid-feedback"><?= $data ['email_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input class="form-control <?= (!empty ($data ['password_err'])) ? 'is-invalid' : '' ?>"
                        type="password" name="password" placeholder="Enter Password" value="<?= $data ['password'] ?>">
                        <span class="invalid-feedback"><?= $data ['password_err'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password:</label>
                        <input class="form-control <?= (!empty ($data ['name_err'])) ? 'is-invalid' : '' ?>"
                        type="password" name="confirm_password" placeholder="Retype Password" value="<?= $data ['confirm_password'] ?>">
                        <span class="invalid-feedback"><?= $data ['confirm_password_err'] ?></span>
                    </div>
                    <input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Admin">
                </fieldset>
            </form>
        </div>
        <div class="table-responsive table-load">
            <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>S/N</th>
                        <th>Admin Name</th>
                        <th>Admin Email</th>
                        <th>Added By</th>
                        <th>Date & Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php $sn = 0; ?>
                <?php foreach ($data ['users'] as $user) : ?>
                <?php $sn++ ?>
                <tr>
                    <td><?= $sn ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->created_by ?></td>
                    <td><?= $user->created_at ?></td>
                    <td>
                        <form action="<?= URLROOT ?>/cms/delete_admin/<?= $user->id ?>" method="post">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php require_once APPROOT . '\views\inc\cms\footer.inc.php'; ?>