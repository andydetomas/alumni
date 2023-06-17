<style>
    header.masthead, header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }

    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }

    .form-group .required:after {
        content: " *";
        color: red;
        font-weight: 100;
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Tracer Study</h3>
                <hr class="divider my-4"/>
                <h6 class="text-white mt-n3">2023</h6>
                <p class="text-white"><small>This survey aims to gather data regarding our alumni's current status and contact information to
                        gain insight into a possible institutional quality improvements and provide statistical information</small></p>
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
                    <div class="col-md-12">
                        <form action="" id="create_account">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">First Name</label>
                                    <input type="text" class="form-control" name="firstname" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Middle Name</label>
                                    <input type="text" class="form-control" name="middlename">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Gender</label>
                                    <select class="custom-select" name="gender" required>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Batch</label>
                                    <input type="input" class="form-control datepickerY" name="batch" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Course Graduated</label>
                                    <select class="custom-select select2" name="course_id" required>
                                        <option></option>
                                        <?php
                                        $course = $conn->query("SELECT * FROM courses order by course asc");
                                        while ($row = $course->fetch_assoc()):
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['course'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Company/Business</label>
                                    <textarea name="connected_to" id="" cols="30" rows="3"
                                              class="form-control"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Image</label>
                                    <input type="file" class="form-control" name="img"
                                           onchange="displayImg(this,$(this))" required>
                                    <img src="" alt="" id="cimg">

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label required">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div id="msg">

                            </div>
                            <div class="row form-group">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary">Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('.datepickerY').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
    $('.select2').select2({
        placeholder: "Please Select Here",
        width: "100%"
    });
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#create_account').submit(function (e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Account is pending for verification.", 'success');
                    setTimeout(function () {
                        location.replace('index.php');
                    }, 5000);
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">Email already exist.</div>');
                    end_load();
                } else {
                    $('#msg').html('<div class="alert alert-danger">Error in creating your account.</div>');
                    end_load();
                }
            }
        })
    })
</script>