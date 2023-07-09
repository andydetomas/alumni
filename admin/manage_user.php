<?php
include('db_connect.php');
session_start();
if (isset($_GET['id'])) {
    $user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
    foreach ($user->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}
?>
<div class="container-fluid">
    <div id="msg"></div>

    <form action="" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) && $meta['id'] != null ? $meta['id'] : '' ?>">
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control"
                   value="<?php echo isset($meta['first_name']) ? $meta['first_name'] : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="name">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control"
                   value="<?php echo isset($meta['middle_name']) ? $meta['middle_name'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control"
                   value="<?php echo isset($meta['last_name']) ? $meta['last_name'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control"
                   value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
            <?php if (isset($meta['id'])): ?>
                <small><i>Leave this blank if you dont want to change the password.</i></small>
            <?php endif; ?>
        </div>
        <?php if (isset($meta['type']) && $meta['type'] == 3): ?>
            <input type="hidden" name="type" value="3">
        <?php else: ?>
            <?php if (! isset($_GET['mtype'])): ?>
                <div class="form-group">
                    <label for="type">User Type</label>
                    <select name="type" id="type" class="custom-select">
                        <option value="OFFICER" <?php echo isset($meta['type']) && $meta['type'] == 'OFFICER' ? 'selected' : '' ?>>
                            Staff
                        </option>
                        <option value="ADMIN" <?php echo isset($meta['type']) && $meta['type'] == 'ADMIN' ? 'selected' : '' ?>>
                            Admin
                        </option>
                    </select>
                </div>
            <?php endif; ?>
        <?php endif; ?>


    </form>
</div>
<script>

    $('#manage-user').submit(function (e) {
        e.preventDefault();
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_user',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                console.log(resp);
                if (resp == 1) {
                    alert_toast("Data successfully saved", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">Username already exist</div>')
                    end_load()
                } else {
                    $('#msg').html('<div class="alert alert-danger">You have encountered an error.</div>')
                    end_load()
                }
            }
        })
    })

</script>