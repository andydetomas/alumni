<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user
            </button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'db_connect.php';
                    $users = $conn->query("SELECT * FROM users where (type = 'ADMIN' OR type = 'OFFICER') order by first_name asc");
                    $i = 1;
                    while ($row = $users->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo ucwords($row['first_name'])." ".ucwords($row['middle_name'])." ".ucwords($row['last_name']) ?>
                            </td>

                            <td>
                                <?php echo $row['username'] ?>
                            </td>
                            <td>
                                <?php echo $row['type'] ?>
                            </td>
                            <td>
                                <?php echo $row['status'] ?>
                            </td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button"
                                                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit_user" href="javascript:void(0)"
                                               data-id='<?php echo $row['id'] ?>'>Edit</a>
                                            <div class="dropdown-divider"></div>
                                           <?php if($row['status'] == 'INACTIVE'):?>
                                            <a class="dropdown-item activate_user" href="javascript:void(0)"
                                               data-id='<?php echo $row['id'] ?>'>Activate</a>
                                            <?php else: ?>
                                            <a class="dropdown-item delete_user" href="javascript:void(0)"
                                               data-id='<?php echo $row['id'] ?>'>Deactivate</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </center>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    $('table').dataTable();
    $('#new_user').click(function () {
        uni_modal('New User', 'manage_user.php')
    })
    $('.edit_user').click(function () {
        uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
    $('.activate_user').click(function () {
        _conf("Are you sure you want to activate this user?", "activate_user", [$(this).attr('data-id')])
    })
    $('.delete_user').click(function () {
        _conf("Are you sure to deactivate this user?", "delete_user", [$(this).attr('data-id')])
    })

    function delete_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_user',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("User successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
    function activate_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=activate_user',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("User successfully activated", 'success');
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>