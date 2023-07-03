<?php
if (isset($_SESSION['bio']['course_id'])) {
    $qry_course = $conn->query("SELECT * FROM courses WHERE id=".$_SESSION['bio']['course_id'])->fetch_assoc();
    $course = $qry_course['course'];

    $qry_tracer = $conn->query("SELECT * FROM tracer_version WHERE status='ACTIVE' ORDER BY id DESC LIMIT 1")->fetch_assoc();
    $version = 0;
    $tracer_answer = 0;

    if(isset($qry_tracer)) {
        $version = $qry_tracer['version'];
        if ($version) {
            $tracer_answer = $conn->query("SELECT * FROM tracer_survey WHERE tracer_version='{$qry_tracer['id']}' and user_id=".$_SESSION['login_id'])->num_rows;
        }
    }
}

?>
<style>
    header.masthead, header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }

    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row align-items-center justify-content-center text-center" style="height: 90%">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Employability Tracer Study</h3>
                <hr class="divider my-4"/>
                <h6 class="text-white mt-n3"><?php echo $version ?></h6>
                <p class="text-white"><small>Kindly complete this questionnaire accurately and truthfully. Your
                        responses will be used for research purposes to assess employability and eventually, improve the
                        curriculum of the programs offered in the Western Mindanao State University (WMSU). Your answers
                        to this survey will be treated with utmost confidentiality. Thank you very much!</small></p>
                <div class="col-md-12 mb-5 justify-content-center"></div>
            </div>
        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container-fluid">
                    <?php if($tracer_answer > 0): ?>
                    <div class="col-md-12">
                        <div class="row align-items-center justify-content-center text-center mt-5 mb-5" id="survey_completed">
                            <div class="col-md-12">
                                <h3>Thank you for participating!</h3>
                                <p>We truly value the information you have provided. Your responses will contribute to our
                                    analyses of the employability status of our university graduates. This information will
                                    be used to improve our quality of education.</p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($tracer_answer == 0): ?>
                    <div class="col-md-12">
                        <div class="row mt-3 mb-n2">
                            <div class="col-md-12 text-info">
                                <h5>PART I: GENERAL INFORMATION</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-n2">
                            <div class="col-md-8">
                                <p><b>Full Name:</b>
                                    <span><?php echo $_SESSION['bio']['firstname']." ".$_SESSION['bio']['middlename'].' '.$_SESSION['bio']['lastname'] ?></span>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p><b>Gender:</b> <span><?php echo $_SESSION['bio']['gender'] ?></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p><b>Course:</b> <span><?php echo $course ?></span></p>
                            </div>
                            <div class="col-md-4">
                                <p><b>Year Graduated:</b> <span><?php echo $_SESSION['bio']['batch'] ?></span></p>
                            </div>
                        </div>
                        <div class="row mt-5 mb-n2">
                            <div class="col-md-12 text-info">
                                <h5>PART II: EMPLOYMENT DATA</h5>
                            </div>
                        </div>
                        <hr>
                        <form class="needs-validation" id="survey" novalidate>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <legend class="col-form-label required">Are you currently employed?</legend>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employment_status" id="employment_status" value="true" checked>
                                        <label class="form-check-label" for="employment_status1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employment_status" id="employment_status" value="false">
                                        <label class="form-check-label" for="employment_status2">No</label>
                                    </div>
                                </div>
                                <div class="col-md-4 employed">
                                    <label for="cur_job_status" class="control-label required">Job Status</label>
                                    <select class="custom-select" name="cur_job_status" id="cur_job_status" required>
                                        <option></option>
                                        <?php
                                        $course = $conn->query("SELECT * FROM job_classification where status='ACTIVE' order by name asc");
                                        while ($row = $course->fetch_assoc()):
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4 employed">
                                    <label for="" class="control-label required">How long did it take to find your job?</label>
                                    <select class="custom-select" name="cur_job_find" id="cur_job_find" required>
                                        <option>Less than 1 month</option>
                                        <option>1 month to 6 months</option>
                                        <option>6 months to 12 months</option>
                                        <option>More than 1 year</option>
                                    </select>
                                </div>
                                <div class="col-md-8 unemployed">
                                    <label for="" class="control-label required">Reason for unemployment</label>
                                    <select class="custom-select" name="cur_unemployed_reason" id="cur_unemployed_reason" required>
                                        <option>Further study</option>
                                        <option>Family concerns</option>
                                        <option>Lack of work experience</option>
                                        <option>No job opportunity</option>
                                        <option>Did not look for a job</option>
                                        <option>Other Reasons</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group employed">
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Company</label>
                                    <input type="text" class="form-control" name="cur_job_company" id="cur_job_company" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Current Job Title</label>
                                    <select class="custom-select" name="cur_job" id="cur_job" required>
                                        <option></option>
                                        <?php
                                        $job = $conn->query("SELECT * FROM job_type where status='ACTIVE' order by case when name = 'Other' then 1 else 2 end, name asc");
                                        while ($row = $job->fetch_assoc()):
                                            ?>
                                            <option value="<?php echo $row['id'] ?>">
                                                <?php echo $row['name'] == 'Other' ? 'Other (please specify)' : $row['name'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Other Job <small>(please specify)</small></label>
                                    <input type="text" class="form-control" name="cur_job_other" id="cur_job_other" required disabled>
                                </div>
                            </div>
                            <div class="row form-group employed">
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Year Started</label>
                                    <input type="input" class="form-control datepickerY" name="cur_job_start" id="cur_job_start" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Year Ended <small><i>(Select current year if still employed)</i></small></label>
                                    <input type="input" class="form-control datepickerY" name="cur_job_end" id="cur_job_end" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">How much is your monthly salary?</label>
                                    <select class="custom-select" name="cur_job_salary" id="cur_job_salary" required>
                                        <option>Less than ₱9,100</option>
                                        <option>Between ₱9,100 to ₱18,200</option>
                                        <option>Between ₱18,200 to ₱36,400</option>
                                        <option>Between ₱36,400 to ₱63,700</option>
                                        <option>Between ₱63,700 to ₱109,200</option>
                                        <option>Between ₱109,200 to ₱182,000</option>
                                        <option>At least ₱182,000 and up</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <legend class="col-form-label required">Is this your first job?</legend>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="firstJobStatus" id="firstJobStatus" value="true" checked>
                                        <label class="form-check-label" for="firstJobStatus1">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="firstJobStatus" id="firstJobStatus" value="false">
                                        <label class="form-check-label" for="firstJobStatus2">No</label>
                                    </div>
                                </div>
                                <div class="col-md-8 award">
                                    <label for="" class="control-label">Awards or Recognitions received from employment</label>
                                    <textarea name="award_job" id="" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row form-group first">
                                <div class="col-md-4">
                                    <label for="first_job_status" class="control-label required">First Job Status</label>
                                    <select class="custom-select" name="first_job_status" id="firstr_job_status" >
                                        <option></option>
                                        <?php
                                        $course = $conn->query("SELECT * FROM job_classification where status='ACTIVE' order by name asc");
                                        while ($row = $course->fetch_assoc()):
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">First Job Title</label>
                                    <select class="custom-select" name="first_job" id="first_job">
                                        <option></option>
                                        <?php
                                        $job = $conn->query("SELECT * FROM job_type where status='ACTIVE' order by case when name = 'Other' then 1 else 2 end, name asc");
                                        while ($row = $job->fetch_assoc()):
                                            ?>
                                            <option value="<?php echo $row['id'] ?>">
                                                <?php echo $row['name'] == 'Other' ? 'Other (please specify)' : $row['name'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Other Job <small>(please specify)</small></label>
                                    <input type="text" class="form-control" name="first_job_other" id="first_job_other" disabled>
                                </div>
                            </div>
                            <div class="row mt-5 mb-n2">
                                <div class="col-md-12 text-info">
                                    <h5>PART III: CONTINUING EDUCATION</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-md-8">
                                    <label for="" class="control-label">Post Graduate Course / MBA / PHD</label>
                                    <input type="text" class="form-control" name="grad_course">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Status of further studies</label>
                                    <select class="custom-select" name="grad_course_status">
                                        <option></option>
                                        <option>On-going</option>
                                        <option>Completed</option>
                                        <option>Onhold</option>
                                    </select>
                                </div>
                            </div>
                            <div id="msg">

                            </div>
                            <input type="hidden" name="tracer_version" value="<?php echo $qry_tracer['id']; ?>" />
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#first_job').change(function(e){
            if ($("#first_job option:selected").val() == 1) {
                $("#first_job_other").prop("disabled", false);
            } else {
                $("#first_job_other").prop("disabled", 'disabled');
            }
        });
        $('#cur_job').change(function(e){
            if ($("#cur_job option:selected").val() == 1) {
                $("#cur_job_other").prop("disabled", false);
            } else {
                $("#cur_job_other").prop("disabled", 'disabled');
            }
        });

        //Default
        var defaultValEmployment = $("input[name$='employment_status']").attr("value");
        var defaultValFirst = $("input[name$='firstJobStatus']").attr("value");
        if (defaultValEmployment == 'true') {
            $("div.unemployed").hide();
        }
        if (defaultValFirst == 'true') {
            $("div.first").hide();
        }

        $("input[name$='employment_status']").click(function() {
            var inputValue = $(this).attr("value");
            if(inputValue == 'true') {
                $("div.employed").show();
                $("div.unemployed").hide();
                $("div.award").show();

                $("#cur_job_status").prop('required',true);
                $("#cur_job_find").prop('required',true);
                $("#cur_job_company").prop('required',true);
                $("#cur_job").prop('required',true);
                $("#cur_job_other").prop('required',true);
                $("#cur_job_start").prop('required',true);
                $("#cur_job_end").prop('required',true);
                $("#cur_job_salary").prop('required',true);

            } else {
                $("div.unemployed").show();
                $("div.employed").hide();
                $("div.award").hide();

                $("#cur_job_status").removeAttr("required");
                $("#cur_job_find").removeAttr("required");
                $("#cur_job_company").removeAttr("required");
                $("#cur_job").removeAttr("required");
                $("#cur_job_other").removeAttr("required");
                $("#cur_job_start").removeAttr("required");
                $("#cur_job_end").removeAttr("required");
                $("#cur_job_salary").removeAttr("required");
            }
        });

        $("input[name$='firstJobStatus']").click(function() {
            var inputValue = $(this).attr("value");
            if(inputValue == 'false') {
                $("div.first").show();
                $("div.award").show();

                $("#first_job_status").prop('required',true);
                $("#first_job").prop('required',true);
                $("#first_job_other").prop('required',true);

            } else {
                $("div.first").hide();
                $("div.award").hide();

                $("#first_job_status").removeAttr("required");
                $("#first_job").removeAttr("required");
                $("#first_job_other").removeAttr("required");
            }
        });
    });
</script>
<script>
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        event.stopPropagation();
                        start_load();
                        $.ajax({
                            url: 'admin/ajax.php?action=survey',
                            data: new FormData($(this)[0]),
                            cache: false,
                            contentType: false,
                            processData: false,
                            method: 'POST',
                            type: 'POST',
                            success: function (resp) {
                                if (resp == 1) {
                                    alert_toast("Answers has been submitted.", 'success');
                                    location.reload();
                                } else {
                                    console.log(resp);
                                    $('#msg').html('<div class="alert alert-danger">Error in submitting your answers.</div>');
                                    end_load();
                                }
                            }
                        })
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script>
    $('.datepickerY').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        endDate:new Date()
    });
    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    });
</script>
