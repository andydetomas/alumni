<?php

    function getLabelsByYears($pastYearsRange, $futureYearsRange) {
        $arr = array();

        $startYear = date("Y") - $pastYearsRange;
        $endYear = date("Y") + $futureYearsRange;
        for ($i = $startYear; $i <= $endYear; $i++) {
            array_push($arr, $i);
        }

        return $arr;
    }

    function getEmployedData($conn, $listOfYears) {
        $arr = array();
        foreach ($listOfYears as $value) {
            $row = $conn->query("SELECT COUNT(id) as employed FROM tracer_survey where cur_job_start <= '$value' and cur_job_end >= '$value'")->fetch_assoc();
            array_push($arr, isset($row['employed']) && $row['employed'] != null ? $row['employed'] : 0);
        }

        return $arr;
    }

    function getUnemployedData($conn, $listOfYears) {
        $arr = array();
        foreach ($listOfYears as $value) {
            $row = $conn->query("SELECT COUNT(s.id) as unemployed FROM tracer_survey s LEFT JOIN tracer_version t on s.tracer_version=t.id where s.cur_employed='UNEMPLOYED' and t.version = '$value'")->fetch_assoc();
            array_push($arr, isset($row['unemployed']) && $row['unemployed'] != null ? $row['unemployed'] : 0);
        }

        return $arr;
    }

    function getEmployedWhileStudying($conn, $listOfYears) {
        $arr = array();
        foreach ($listOfYears as $value) {
            $row = $conn->query("SELECT COUNT(id) as employed FROM tracer_survey where cur_job_start <= '$value' and cur_job_end >= '$value' and grad_course <> ''")->fetch_assoc();
            array_push($arr, isset($row['employed']) && $row['employed'] != null ? $row['employed'] : 0);
        }

        return $arr;
    }

    function getLabelsByStatus($conn) {
        $arr = array();
        $course = $conn->query("SELECT * FROM job_classification where status='ACTIVE' order by name asc");
        while ($row = $course->fetch_assoc()) {
            array_push($arr, $row['name']);
        }
        return $arr;
    }

    function getLabelsByLength() {
        return array("Less than 1 month", "1 month to 6 months", "6 months to 12 months", "More than 1 year");
    }

    function getLabelsBySalary() {
        //Salary range are based on income class in the philippines
        return array("Less than ₱9,100", "Between ₱9,100 to ₱18,200", "Between ₱18,200 to ₱36,400",
            "Between ₱36,400 to ₱63,700", "Between ₱63,700 to ₱109,200", "Between ₱109,200 to ₱182,000",
            "At least ₱182,000 and up");
    }

    function getLabelsByJob($conn) {
        $arr = array();
        $job = $conn->query("SELECT * FROM job_type order by name asc");
        while ($row = $job->fetch_assoc()) {
            array_push($arr, $row['name']);
        }
        return $arr;
    }

    function getEmployedStatusForCurYear($conn, $curYear, $listOfStatus) {
        $arr = array();
        foreach ($listOfStatus as $value) {
            $row = $conn->query("SELECT COUNT(s.id) AS employed FROM tracer_survey s 
                                LEFT JOIN job_classification cs ON s.cur_job_status = cs.id
                                WHERE cur_job_start <= '$curYear' AND cur_job_end >= '$curYear' AND cs.name='$value'")->fetch_assoc();
            array_push($arr, isset($row['employed']) && $row['employed'] != null ? $row['employed'] : 0);
        }

        return $arr;
    }

    function getEmployedLengthForCurYear($conn, $curYear, $listOfLength) {
        $arr = array();
        foreach ($listOfLength as $value) {
            $row = $conn->query("SELECT COUNT(s.id) AS employed FROM tracer_survey s WHERE cur_job_start <= '$curYear' AND cur_job_end >= '$curYear' AND cur_job_find LIKE '%$value%'")->fetch_assoc();
            array_push($arr, isset($row['employed']) && $row['employed'] != null ? $row['employed'] : 0);
        }

        return $arr;
    }

    function getEmployedSalaryForCurYear($conn, $curYear, $listOfSalaryClass) {
        $arr = array();
        foreach ($listOfSalaryClass as $value) {
            $row = $conn->query("SELECT COUNT(s.id) AS employed FROM tracer_survey s WHERE cur_job_start <= '$curYear' AND cur_job_end >= '$curYear' AND cur_job_salary LIKE '%$value%'")->fetch_assoc();
            array_push($arr, isset($row['employed']) && $row['employed'] != null ? $row['employed'] : 0);
        }

        return $arr;
    }

    function getEmployedJobForCurYear($conn, $curYear, $listOfJobs) {
        $arr = array();
        foreach ($listOfJobs as $value) {
            $row = $conn->query("SELECT COUNT(s.id) AS employed FROM tracer_survey s 
                                    LEFT JOIN job_type jt ON s.cur_job = jt.id
                                    WHERE cur_job_start <= '$curYear' AND cur_job_end >= '$curYear' AND jt.name='$value'")->fetch_assoc();
            array_push($arr, isset($row['employed']) && $row['employed'] != null ? $row['employed'] : 0);
        }

        return $arr;
    }

    function getAllSurveyAnswers($conn) {
        $row = $conn->query("SELECT s.id, CONCAT(u.first_name,' ',u.last_name) as fullname, fj.name as first_job, first_job_other,
                            fs.name as first_job_status, cur_employed, cur_unemployed_reason, cj.name as cur_job, cur_job_other,
                            cur_job_company, cur_job_find, cur_job_salary, cs.name as cur_job_status, cur_job_start, cur_job_end, grad_course,
                            grad_course_status,award_job, tv.version as tracer_version
                            FROM tracer_survey s
                            LEFT JOIN job_type cj ON s.cur_job = cj.id
                            LEFT JOIN job_type fj ON s.first_job = fj.id
                            LEFT JOIN users u ON s.user_id = u.id
                            LEFT JOIN job_classification fs ON s.first_job_status=fs.id
                            LEFT JOIN job_classification cs ON s.cur_job_status=cs.id
                            LEFT JOIN tracer_version tv ON s.tracer_version=tv.id");
        return $row;
    }

    function getSurveyAnswerById($conn, $id) {
        $row = $conn->query("SELECT s.id, CONCAT(u.first_name,' ',u.last_name) as fullname, fj.name as first_job, first_job_other,
                                fs.name as first_job_status, cur_employed, cur_unemployed_reason, cj.name as cur_job, cur_job_other,
                                cur_job_company, cur_job_find, cur_job_salary, cs.name as cur_job_status, cur_job_start, cur_job_end, grad_course,
                                grad_course_status,award_job,tracer_version
                                FROM tracer_survey s
                                LEFT JOIN job_type cj ON s.cur_job = cj.id
                                LEFT JOIN job_type fj ON s.first_job = fj.id
                                LEFT JOIN users u ON s.user_id = u.id
                                LEFT JOIN job_classification fs ON s.first_job_status=fs.id
                                LEFT JOIN job_classification cs ON s.cur_job_status=cs.id
                                WHERE s.id=$id");
        return $row;
    }
?>