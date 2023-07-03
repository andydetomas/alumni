<?php
    include 'db_connect.php';
    include 'admin_chart.php';

    $qry = $conn->query("SELECT * FROM tracer_version where status = 'ACTIVE' LIMIT 1")->fetch_array();
?>
<div class="container-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <b>Tracer Study Statistic Graphs</b>
                    <span>
                        <?php if(isset($qry['version'])): ?>
                            <a class="btn btn-warning btn-block btn-sm col-sm-4 col-md-2 float-right" id="close_survey" data-id="<?php echo $qry['id'] ?>">
                                Close Survey
				            </a>
                        <?php else: ?>
                            <a class="btn btn-primary btn-block btn-sm col-sm-4 col-md-2 float-right text-white" id="new_survey">
                                <i class="fa fa-plus"></i> New Version
                            </a>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 row">
                        <div class="col-lg-6">
                            <canvas id="employmentChart" style="width:100%;max-width:100%"></canvas>
                        </div>
                        <div class="col-lg-6">
                            <canvas id="employmentGradChart" style="width:100%;max-width:100%"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-12 row mt-5">
                        <h6>Data for <?php echo date("Y"); ?></h6>
                    </div>
                    <hr>
                    <div class="col-lg-12 row mt-3">
                        <div class="col-lg-6">
                            <canvas id="statusByCurYear" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div class="col-lg-6">
                            <canvas id="lengthByCurYear" style="width:100%;max-width:700px"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-12 row mt-5">
                        <div class="col-lg-6">
                            <canvas id="salaryByCurYear" style="width:100%;max-width:700px"></canvas>
                        </div>
                        <div class="col-lg-6">
                            <canvas id="courseEmployed" style="width:100%;max-width:700px"></canvas>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="">Full Name</th>
                                <th class="">Status</th>
                                <th class="">Current Job <small>
                                        <i class="fa fa-info-circle text-info" data-toggle="tooltip"
                                           data-placement="top"
                                           title="The job pertains to the current work on the year this survey is submitted">
                                        </i></small>
                                </th>
                                <th class="">Graduate Course</th>
                                <th class="">Survey Year</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $data = getAllSurveyAnswers($conn);
                            while ($row = $data->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p><?php echo ucwords($row['fullname']) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo ucwords($row['cur_employed']) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo ucwords($row['cur_job']) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo ucwords($row['grad_course']) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo ucwords($row['tracer_version']) ?></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_tracer" type="button"
                                                data-id="<?php echo $row['id'] ?>">More Info
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('table').dataTable()
    });
    $('#new_survey').click(function () {
        uni_modal("Open New Tracer Survey", "manage_tracer.php", 'mid-large')
    });
    $('#close_survey').click(function () {
        _conf("Are you sure to close this survey?", "close_survey", [$(this).attr('data-id')], 'mid-large')
    });
    $('.view_tracer').click(function () {
        uni_modal("Survey Answers", "view_tracer.php?id=" + $(this).attr('data-id'), 'large')
    });

    function close_survey($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=close_survey',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp === 1) {
                    alert_toast("Survey successfully closed!", 'success');
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>

<!--CHARTS Configurations-->
<script>
    // -----------------------------FIRST CHART
    const employmentChart = document.getElementById("employmentChart").getContext("2d");
    const employmentChartData = {
        labels: <?php echo json_encode(getLabelsByYears(4)) ?>,
        datasets: [{
            label: "Employed",
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            data: <?php echo json_encode(getEmployedData($conn, getLabelsByYears(4))) ?>,
            borderWidth: 1
        }, {
            label: "Unemployed",
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode(getUnemployedData($conn, getLabelsByYears(4))) ?>,
            borderWidth: 1
        }]
    };
    new Chart(employmentChart, {
        type: 'bar',
        data: employmentChartData,
        options: {
            barValueSpacing: 20,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        }
    });

    // -----------------------SECOND CHART
    const employmentGradChart = document.getElementById("employmentGradChart").getContext("2d");
    const employmentGradChartData = {
        labels: <?php echo json_encode(getLabelsByYears(4)) ?>,
        datasets: [{
            label: "Employed Only",
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            data: <?php echo json_encode(getEmployedData($conn, getLabelsByYears(4))) ?>,
            borderWidth: 1
        }, {
            label: "Employed while Studying",
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgb(153, 102, 255)',
            data: <?php echo json_encode(getEmployedWhileStudying($conn, getLabelsByYears(4))) ?>,
            borderWidth: 1
        }]
    };
    new Chart(employmentGradChart, {
        type: 'bar',
        data: employmentGradChartData,
        options: {
            barValueSpacing: 20,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }]
            }
        }
    });

    // -----------------------THIRD CHART
    const statusByCurYear = document.getElementById("statusByCurYear").getContext('2d');
    new Chart(statusByCurYear, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(getLabelsByStatus($conn)) ?>,
            datasets: [{
                label: 'food Items',
                backgroundColor: [
                    'rgb(0,0,0)',
                    'rgb(135,81,44)',
                    'rgb(203,182,159)',
                    'rgb(158,1,66)',
                    'rgb(213,62,79)',
                    'rgb(244,109,67)',
                    'rgb(253,174,97)',
                    'rgb(254,224,139)',
                    'rgb(230,245,152)',
                    'rgb(171,221,164)',
                    'rgb(102,194,165)',
                    'rgb(50,136,189)',
                    'rgb(94,79,162)',
                ],
                data: <?php echo json_encode(getEmployedStatusForCurYear($conn, getLabelsByStatus($conn))) ?>,
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: "right"
            },
            title: {
                display: true,
                text: 'Alumni Employed per Status Classification'
            }
        }
    });

    // -----------------------FOURTH CHART
    const lengthByCurYear = document.getElementById("lengthByCurYear").getContext('2d');
    new Chart(lengthByCurYear, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(getLabelsByLength()) ?>,
            datasets: [{
                label: 'food Items',
                backgroundColor: [
                    'rgb(213,62,79)',
                    'rgb(254,224,139)',
                    'rgb(102,194,165)',
                    'rgb(50,136,189)',
                ],
                data: <?php echo json_encode(getEmployedLengthForCurYear($conn, getLabelsByLength())) ?>,
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: "right"
            },
            title: {
                display: true,
                text: 'Time Taken to Find a Job'
            }
        }
    });

    // -----------------------FIFTH CHART
    const salaryByCurYear = document.getElementById("salaryByCurYear").getContext('2d');
    new Chart(salaryByCurYear, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(getLabelsBySalary()) ?>,
            datasets: [{
                label: 'food Items',
                backgroundColor: [
                    'rgb(158,1,66)',
                    'rgb(213,62,79)',
                    'rgb(244,109,67)',
                    'rgb(253,174,97)',
                    'rgb(254,224,139)',
                    'rgb(230,245,152)',
                    'rgb(171,221,164)',
                    'rgb(102,194,165)',
                    'rgb(50,136,189)',
                    'rgb(94,79,162)',
                ],
                data: <?php echo json_encode(getEmployedSalaryForCurYear($conn, getLabelsBySalary())) ?>,
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: "right"
            },
            title: {
                display: true,
                text: 'Alumni Employed per Salary Class'
            }
        }
    });

    // -----------------------SIXTH CHART

    const courseEmployed = document.getElementById("courseEmployed").getContext('2d');
    new Chart(courseEmployed, {
        type: 'pie',
        data: {
            labels:  <?php echo json_encode(getLabelsByJob($conn)) ?>,
            datasets: [{
                label: 'food Items',
                backgroundColor: [
                    'rgb(158,1,66)',
                    'rgb(213,62,79)',
                    'rgb(244,109,67)',
                    'rgb(253,174,97)',
                    'rgb(254,224,139)',
                    'rgb(230,245,152)',
                    'rgb(171,221,164)',
                    'rgb(102,194,165)',
                    'rgb(50,136,189)',
                    'rgb(94,79,162)',
                ],
                data: <?php echo json_encode(getEmployedJobForCurYear($conn, getLabelsByJob($conn))) ?>,
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: "right"
            },
            title: {
                display: true,
                text: 'Employed Job Types'
            }
        }
    });
</script>