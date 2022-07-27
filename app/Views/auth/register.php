<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<div class="p-3 mb-2 bg-light text-dark">
    <div class="container bg-white">
      <div class="row mt-3">
        <span class="border border-primary">
            <div class="col-md-4 offset-4">
                <h4>
                    Sign Up
                </h4>
                <hr>

                <?php
                    if(!empty(session()->getFlashData('success'))){
                        ?>
                        <div class="alert alert-success">
                        <?=
                            session()->getFlashData('success')
                        ?>
                        </div>
                        <?php
                    }else if(!empty(session()->getFlashData('fail'))){
                        ?>
                         <div class="alert alert-danger">
                              <?=
                                 session()->getFlashData('fail')
                              ?>
                         </div>
                         <?php
                    }
                ?>
                <form action="<?= base_url('registerUser')?>" 
                      method="post"
                     class="form mb-3" >
                    
                   <?= csrf_field(); ?>

                   <div class="form-group  mb-3">
                        <label for="">Name</label>
                        <input type="text" 
                               class="form-control"
                               name = "Name"
                               value="<?= set_value('Name');?>"
                               Placeholder = "Name Here">
                               <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'Name') : '' ?>
                               </span>
                    </div>


                    <div class="form-group  mb-3">
                        <label for="">Email</label>
                        <input type="text" 
                               class="form-control"
                               name = "email"
                               value="<?= set_value('email');?>"
                               Placeholder = "Email Here">
                               <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'email') : '' ?>
                               </span>
                    </div>

                    <div class="form-group  mb-3">
                        <label for="">Password</label>
                        <input type="Password" 
                               class="form-control"
                               name = "Password"
                               value="<?= set_value('Password');?>"
                               Placeholder = "Password Here">
                               <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'Password') : '' ?>
                               </span>
                    </div>

                    <div class="form-group  mb-3">
                        <label for="">Confirm Password</label>
                        <input type="Password" 
                               class="form-control"
                               name = "PasswordConf"
                               value="<?= set_value('PasswordConf');?>"
                               Placeholder = "Confirm Password Here">
                               <span class="text-danger text-sm">
                                    <?= isset($validation) ? display_form_errors($validation, 'PasswordConf') : '' ?>
                               </span>
                    </div>

                    <div class="form-group  mb-3">
                    
                        <input type="Submit" 
                               class="btn btn-info"
                               value="Sign Up">

                    </div>
                </form>

                <a href="<?= site_url("login")?>">
                    Already i have an account? Sign In
                </a>
            </div>
            </span>
        </div>
    </div>
</div>
</body>
</html>