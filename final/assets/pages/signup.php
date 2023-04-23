


    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form method = "post" action="assets/php/actions.php?signup">
                <div class="d-flex justify-content-center">


                    <img class="mb-4" src="assets/images/photoshare.png" alt="" height="45">
                </div>

                <h1 class="h5 mb-3 fw-normal">Create new account</h1>
                <div class="d-flex">
                    <div class="form-floating mt-1 col-6 ">

                        <input type="text" name = "firstName" value="<?=showData('firstName')?>" class="form-control rounded-0" placeholder="username/email">
                        <label for="floatingInput">first name</label>
                    </div>
                    <?=catchError('firstName')?>
                    

                    <div class="form-floating mt-1 col-6">
                        <input type="text" name = "lastName" value="<?=showData('lastName')?>" class="form-control rounded-0" placeholder="username/email">
                        <label for="floatingInput">last name</label>
                    </div>
                    <?=catchError('lastName')?>
                </div>
                
                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                            value="1" <?=isset($_SESSION['formdata'])?'':'checked'?> <?=showData('gender')==1?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>

                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios3"
                            value="2" <?=showData('gender')==2?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios3">
                            Female
                        </label>

                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2"
                            value="3" <?=showData('gender')==3?'checked':''?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Other
                        </label>
                    </div>


                </div>
                <div class="form-floating mt-1">
                    <input type="email" name ="email" value="<?=showData('email')?>" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">email</label>
                </div>

                <?=catchError('email')?>
                <div class="form-floating mt-1">
                    <input type="text" name ="hometown" value="<?=showData('hometown')?>" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">hometown</label>
                </div>
                <div class="form-floating mt-1">
                 <input type="date" name ="DOB" value="<?=showData('DOB')?>" class="form-control rounded-0" placeholder="username/email">
                 <label for="floatingInput">DOB</label>
                </div>
                
                <?=catchError('DOB')?>
                <div class="form-floating mt-1">
                    <input type="password" name ="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">password</label>
                </div>

                <?=catchError('password')?>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Sign Up</button>
                    <a href="?login" class="text-decoration-none">Already have an account ?</a>


                </div>

            </form>
        </div>
    </div>


