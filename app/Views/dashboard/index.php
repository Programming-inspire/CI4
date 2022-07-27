<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row pt-3">
            <div class="col-md-8 offset-2">
                <h4>Dashboard</h4>
                <hr>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Image
                                </th>
                                <th scope="col">
                                    Name
                                </th>
                                <th scope="col">
                                    Email
                                </th>
                                <th scope="col">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">
                                <img src="/images/<?=$userInfo['avatar']; ?>" alt="" width="200px" height="150px">
                                <form action="<?= base_url('uploadImage'); ?>"
                                      method="post"
                                      enctype="multipart/form-data">
                                    <input type="file"
                                           class="form-control"
                                           name="userImage"
                                           size="10" />
                                    <hr>
                                    <input type="submit">
                                </form>
                            </th>
                               <td>
                                <?= $userInfo['name'];?>
                               </td>
                               <td>
                               <?= $userInfo['email'];?>
                               </td>
                               <td>
                                <a href="<?= site_url('logout') ?>">
                                   Logout
                                </a>
                               </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php
                    if(!empty(session()->getFlashData('notification'))){
                        ?>
                        <div class="alert alert-info">
                        <?=
                            session()->getFlashData('notification')
                        ?>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</body>
</html>