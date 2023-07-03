<?php
    include 'db_connect.php';
    include 'admin_chart.php';
?>
<?php
if (isset($_GET['id'])) {
    $qry = getSurveyAnswerById($conn, $_GET['id']);;
    foreach ($qry->fetch_array() as $k => $val) {
        $$k = $val;
    }
}
?>
<style type="text/css">
    p {
        margin: unset;
    }

    #uni_modal .modal-footer {
        display: none
    }

    #uni_modal .modal-footer.display {
        display: block
    }
</style>
<div class="container-field">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6">
                <p><b>Name:</b> <?php echo $fullname ?></p>
                <p><b>Current Job:</b> <?php echo $cur_job ?></p>
                <p><b>Current Company:</b> <?php echo $cur_job_company ?></p>
                <p><b>Salary:</b> <?php echo $cur_job_salary ?></p>
            </div>
            <div class="col-md-6">
                <p><b>Status:</b> <?php echo $cur_employed ?></p>
                <p><b>Job Classification:</b> <?php echo $cur_job_status ?></p>
                <p><b>Length it took to find current job:</b> <?php echo $cur_job_find ?></p>
                <p><b>Employed from:</b> <?php echo $cur_job_start." to ".$cur_job_end ?></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><b>First Job:</b> <?php echo $first_job ?></p>
                <p><b>More Description:</b> <?php echo $first_job_other ?></p>
            </div>
            <div class="col-md-6">
                <p><b>Status:</b> <?php echo $first_job_status ?></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><b>Graduate Course:</b> <?php echo $grad_course ?></p>
                <p><b>Awards Received During Employment:</b> <?php echo $award_job ?></p>
            </div>
            <div class="col-md-6">
                <p><b>Graduate Status:</b> <?php echo $grad_course_status ?></p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer display">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
