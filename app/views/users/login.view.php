<?php require_once APPROOT . '\views\inc\blog\header.inc.php'; ?>
    <section>
        <div class="login-form">
            <form action="<?= URLROOT ?>/users/login" method="post">
                <div class="login-form-head">
                    <h1>Login</h1>
                    <h4>Enter your credentials</h4>
                </div>
                
                <span class="invalid-feedback"><?= $data ['user_err'] ?></span>
                <div class="form-field">
                    <label for="email">Email: </label>
                    <div class="field">
                        <span><i class="fas fa-at"></i></span>
                        <input type="text" name="email" class="<?= (!empty ($data ['name_err'])) ? 'is-invalid' : '' ?>" 
                        placeholder="Enter Email" value="<?= $data ['email'] ?>">
                    </div>
                    <span class="invalid-feedback"><?= $data ['email_err'] ?></span>
                </div>
                <div class="form-field">
                    <label for="password">Password: </label>
                    <div class="field">
                        <span><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="<?= (!empty ($data ['name_err'])) ? 'is-invalid' : '' ?>" 
                        placeholder="Enter Password">
                    </div>
                    <span class="invalid-feedback"><?= $data ['password_err'] ?></span>
                </div>
                <div class="form-btn">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </section>
<?php require_once APPROOT . '\views\inc\blog\footer.inc.php'; ?>