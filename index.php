<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>User</title>
  </head>
  <body>

<?php require_once("CRUDquery.php") ?>

<div class="container">
        <div class="row my-5 text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-tools text-right">
                            <button type="button" class="btn btn-primary new-user" data-toggle="modal" data-target="#openModal">
                                New user
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <?php if(isset($_SESSION['msg'])): ?>
                            <div class="<?= $_SESSION['alert']; ?>">
                                <?= $_SESSION['msg'];
                                unset($_SESSION['msg']); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="CRUDquery.php" method="POST">
                                    <?php
                                        # user data
                                        $sQuery = "SELECT * FROM user LIMIT 20";
                                        $result = $conn->query($sQuery);
                                        $x = 0;
                                        $x++;
                                        while($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['lastname']; ?></td>
                                            <td><?= $row['updated_at']; ?></td>
                                            <td width="10%">
                                                <button type="submit" name="delete" value="<?= $row['id']; ?>" class="btn btn-danger">Delete</button>

                                                <button type="button" name="edit" value="<?= $row['id']; ?>" id="<?= $x; $x++ ?>" class="btn btn-info mt-2">Update</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="openModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="CRUDquery.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">User info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save-modal" name="save">Save</button>
                        <button type="submit" class="btn btn-success edit-modal" id="edit" name="edit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").remove();
            }, 3000)

            $(".new-user").click(function() {
                $(".save-modal").css("display", "block");
                $(".edit-modal").css("display", "none");
                
                $("#username").val("");
                $("#lastname").val("");
            })

            $(".btn-info").click(function() {
                $("#openModal").modal("show");
                $(".save-modal").css("display", "none");
                $(".edit-modal").css("display", "block");
                $(".table").find('tr').eq(this.id).each(function() {
                    $("#username").val($(this).find('td').eq(1).text());
                    $("#lastname").val($(this).find('td').eq(2).text());
                })
                $("#edit").val(this.value);
            })
        })

    </script>

  </body>
</html>