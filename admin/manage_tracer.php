<?php include 'db_connect.php' ?>
<div class="container-fluid">
    <form action="" id="manage-tracer">
        <div class="row form-group">
            <div class="col-md-12">
                <label class="control-label required">Survey Year</label>
                <input type="input" class="form-control datepickerY" name="version" id="version" required>
            </div>
            <div id="msg">

            </div>
        </div>
    </form>
</div>

<script>
    $('.text-jqte').jqte();
    $('#manage-tracer').submit(function (e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=new_survey',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("New tracer version is opened!", 'success');
                    setTimeout(function () {
                        location.reload()
                    }, 1000)
                } else {
                    $('#msg').html('<div class="alert alert-danger">We have already gathered a survey for this year.' +
                        'Please select another year.</div>');
                    end_load();
                }
            }
        })
    })
</script>
<script>
    $('.datepickerY').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
</script>