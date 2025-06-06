
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form method="post" action="assets/php/actions.php?login">
                <div class="d-flex justify-content-center">

                    <img class="mb-4" src="assets/images/photoshare.png" alt="" height="45">
                </div>
                <h1 class="h5 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="email" name="useremail" value="<?=showData('useremail')?>" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">email</label>
                </div>
                <?=catchError('useremail')?>

                <div class="form-floating mt-1">
                    <input type="password" name= "userpassword" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">password</label>
                </div>
                <?=catchError('userpassword')?>
                <?=catchError('checkUserLogin')?>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Sign in</button>
                    <a href="?signup" class="text-decoration-none">Create New Account</a>


                </div>
                <a href="#" class="text-decoration-none">Forgot password ?</a>
            </form>
        </div>
    </div>


