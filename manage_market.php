<?php include 'admin/db_connect.php' ?>
<div class="container-fluid">
    <form action="" id="save-market">
        <input type="hidden" name="id" id="" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>" class="form-control">
        <div class="row form-group">
            <div class="col-md-12">
                <label class="control-label">Please select the quantity you want to reserve</label>
                <label class="control-label"><small><i>(Maximum of 5 per person)</i></small></label>
                <select name="quantity" id="" class="custom-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
    </form>
</div>
<script>
    $('#save-market').submit(function (e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=save_reserve',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Reservation successfully saved.", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1000)
                }
            }
        })
    })
</script>