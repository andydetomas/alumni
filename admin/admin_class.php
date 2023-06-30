<?php
session_start();
ini_set('display_errors', 1);

Class Action
{
    private $db;

    public function __construct()
    {
        ob_start();
        include 'db_connect.php';

        $this->db = $conn;
    }

    function __destruct()
    {
        $this->db->close();
        ob_end_flush();
    }

    function login()
    {
        extract($_POST);
        $qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."'");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && ! is_numeric($key)) {
                    $_SESSION['login_'.$key] = $value;
                }
            }
            if ($_SESSION['login_type'] == 'OFFICER') {
                foreach ($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }
                return 'OFFICER';
            }
            else if ($_SESSION['login_type'] == 'ADMIN') {
                return 'ADMIN';
            } else {
                return 'ALUMNI'; //alumni found
            }
        } else {
            return null; //no user found
        }
    }

    function login2()
    {
        extract($_POST);
        if (isset($email)) {
            $username = $email;
        } else {
            $password = md5($password);
        }
        $qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && ! is_numeric($key)) {
                    $_SESSION['login_'.$key] = $value;
                }
            }
            if (isset($_SESSION['login_id'])) {
                $bio = $this->db->query("SELECT * FROM alumnus_bio where user_id = ".$_SESSION['login_id']);
                if ($bio->num_rows > 0) {
                    foreach ($bio->fetch_array() as $key => $value) {
                        if ($key != 'password' && ! is_numeric($key)) {
                            $_SESSION['bio'][$key] = $value;
                        }
                    }
                }
            }
            if (isset($_SESSION['bio']['status']) && $_SESSION['bio']['status'] != 'ACTIVE') {
                foreach ($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }
                return 2;
                exit;
            }
            return 1;
        } else {
            return 3;
        }
    }

    function logout()
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }

    function logout2()
    {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:../index.php");
    }

    function save_user()
    {
        extract($_POST);
        $data = " name = '$name' ";
        $data .= ", username = '$username' ";
        if (! empty($password)) {
            $data .= ", password = '".md5($password)."' ";
        }
        $data .= ", type = '$type' ";
        if ($type == 1) {
            $establishment_id = 0;
        }
        $data .= ", establishment_id = '$establishment_id' ";
        $chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
        if ($chk > 0) {
            return 2;
            exit;
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO users set ".$data);
        } else {
            $save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_user()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM users where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function signup()
    {
        extract($_POST);
        $data = " first_name = '$firstname' ";
        $data .= ", middle_name = '$middlename' ";
        $data .= ", last_name = '$lastname' ";
        $data .= ", username = '$email' ";
        $data .= ", password = '".md5($password)."' ";
        $data .= ", type = 'ALUMNI' ";
        $chk = $this->db->query("SELECT * FROM users where username = '$email'")->num_rows;
        if ($chk > 0) {
            return 2;
            exit;
        }
        $save = $this->db->query("INSERT INTO users set ".$data);
        if ($save) {
            $uid = $this->db->insert_id;
            $data = " user_id = '$uid' ";;
            foreach ($_POST as $k => $v) {
                if ($k == 'password') {
                    continue;
                }
                if (!is_numeric($k)) {
                    $data .= ", $k = '$v' ";
                }
            }

            if ($_FILES['img']['tmp_name'] != '') {
                $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/'.$fname);
                $data .= ", avatar = '$fname' ";
            }

            $save_alumni = $this->db->query("INSERT INTO alumnus_bio set ".$data);
            if ($save_alumni) {
                return 1;
            }
        }
    }

    function update_account()
    {
        extract($_POST);
        $data = " first_name = '$firstname' ";
        $data .= ", middle_name = '$middlename' ";
        $data .= ", last_name = '$lastname' ";
        $data .= ", username = '$email' ";
        if (! empty($password)) {
            $data .= ", password = '".md5($password)."' ";
        }
        $chk = $this->db->query("SELECT * FROM users where username = '$email' and id != ".$_SESSION['login_id'])->num_rows;
        if ($chk > 0) {
            return 2;
            exit;
        }
        $save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
        if ($save) {
            $row = $this->db->query("SELECT * FROM users where id= '{$_SESSION['login_id']}' ")->fetch_assoc();
            $_POST['password']=$row['password']; //Get password to enabled logging in again

            $data = '';
            foreach ($_POST as $k => $v) {
                if ($k == 'password') {
                    continue;
                }
                if (empty($data) && ! is_numeric($k)) {
                    $data = " $k = '$v' ";
                } else {
                    $data .= ", $k = '$v' ";
                }
            }
            if ($_FILES['img']['tmp_name'] != '') {
                $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/'.$fname);
                $data .= ", avatar = '$fname' ";
            }
            $save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
            if ($save_alumni) {
                foreach ($_SESSION as $key => $value) {
                    unset($_SESSION[$key]);
                }
                $login = $this->login2();
                if ($login) {
                    return 1;
                }
            }
        }
    }

    function save_settings()
    {
        extract($_POST);
        $data = " name = '".str_replace("'", "&#x2019;", $name)."' ";
        $data .= ", email = '$email' ";
        $data .= ", contact = '$contact' ";
        $data .= ", about_content = '".htmlentities(str_replace("'", "&#x2019;", $about))."' ";
        if ($_FILES['img']['tmp_name'] != '') {
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
            $move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/'.$fname);
            $data .= ", cover_img = '$fname' ";
        }

        // echo "INSERT INTO system_settings set ".$data;
        $chk = $this->db->query("SELECT * FROM system_settings");
        if ($chk->num_rows > 0) {
            $save = $this->db->query("UPDATE system_settings set ".$data);
        } else {
            $save = $this->db->query("INSERT INTO system_settings set ".$data);
        }
        if ($save) {
            $query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
            foreach ($query as $key => $value) {
                if (! is_numeric($key)) {
                    $_SESSION['settings'][$key] = $value;
                }
            }

            return 1;
        }
    }

    function save_course()
    {
        extract($_POST);
        $data = " course = '$course' ";
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO courses set $data");
        } else {
            $save = $this->db->query("UPDATE courses set $data where id = $id");
        }
        if ($save) {
            return 1;
        }
    }

    function delete_course()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM courses where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function delete_alumni()
    {
        extract($_POST);
        $delete = $this->db->query("UPDATE alumni_bio set status = 'INACTIVE' where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function update_alumni_acc()
    {
        extract($_POST);
        $update = $this->db->query("UPDATE alumnus_bio set status = '$status' where id = $id");
        if ($update) {
            return 1;
        }
    }

    function save_gallery()
    {
        extract($_POST);
        $data = "about = '$about' ";
        if ($_FILES['path']['tmp_name'] != '') {
            $_FILES['path']['name'] = str_replace(["(", ")", " "], '', $_FILES['path']['name']);
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['path']['name'];
            $move = move_uploaded_file($_FILES['path']['tmp_name'], 'assets/uploads/gallery/'.$fname);
            $data .= ", path = '$fname' ";
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO gallery set ".$data);
        } else {
            $save = $this->db->query("UPDATE gallery set ".$data." where id=".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_gallery()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM gallery where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function save_career()
    {
        extract($_POST);
        $data = " company = '$company' ";
        $data .= ", job_title = '$title' ";
        $data .= ", location = '$location' ";
        $data .= ", description = '".htmlentities(str_replace("'", "&#x2019;", $description))."' ";

        if (empty($id)) {
            // echo "INSERT INTO careers set ".$data;
            $data .= ", user_id = '{$_SESSION['login_id']}' ";
            $save = $this->db->query("INSERT INTO careers set ".$data);
        } else {
            $save = $this->db->query("UPDATE careers set ".$data." where id=".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_career()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM careers where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function save_forum()
    {
        extract($_POST);
        $data = " title = '$title' ";
        $data .= ", description = '".htmlentities(str_replace("'", "&#x2019;", $description))."' ";

        if (empty($id)) {
            $data .= ", user_id = '{$_SESSION['login_id']}' ";
            $save = $this->db->query("INSERT INTO forum_topics set ".$data);
        } else {
            $save = $this->db->query("UPDATE forum_topics set ".$data." where id=".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_forum()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM forum_topics where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function save_comment()
    {
        extract($_POST);
        $data = " comment = '".htmlentities(str_replace("'", "&#x2019;", $comment))."' ";

        if (empty($id)) {
            $data .= ", topic_id = '$topic_id' ";
            $data .= ", user_id = '{$_SESSION['login_id']}' ";
            $save = $this->db->query("INSERT INTO forum_comments set ".$data);
        } else {
            $save = $this->db->query("UPDATE forum_comments set ".$data." where id=".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_comment()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM forum_comments where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function save_event()
    {
        extract($_POST);
        $data = " user_id = '{$_SESSION['login_id']}' ";
        $data .= ", title = '$title' ";
        $data .= ", schedule = '$schedule' ";
        $data .= ", content = '".htmlentities(str_replace("'", "&#x2019;", $content))."' ";
        if ($_FILES['banner']['tmp_name'] != '') {
            $_FILES['banner']['name'] = str_replace(["(", ")", " "], '', $_FILES['banner']['name']);
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['banner']['name'];
            $move = move_uploaded_file($_FILES['banner']['tmp_name'], 'assets/uploads/'.$fname);
            $data .= ", banner = '$fname' ";
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO events set ".$data);
        } else {
            $save = $this->db->query("UPDATE events set ".$data." where id=".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_event()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM events where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function participate()
    {
        extract($_POST);
        $data = " event_id = '$event_id' ";
        $data .= ", user_id = '{$_SESSION['login_id']}' ";
        $commit = $this->db->query("INSERT INTO event_commits set $data ");
        if ($commit) {
            return 1;
        }
    }

    function save_reserve()
    {
        extract($_POST);
        $data = " product_id = '$id' ";
        $data .= ", user_id = '{$_SESSION['login_id']}' ";
        $data .= ", quantity = '$quantity' ";
        $data .= ", status = 'RESERVED' ";
        $commit = $this->db->query("INSERT INTO product_commits set $data");
        if ($commit) {
            return 1;
        }
    }

    function delete_reserve()
    {
        extract($_POST);
        $data = " status = 'CANCELLED' ";
        $delete = $this->db->query("UPDATE product_commits set ".$data." where product_id=".$id." and user_id=".$_SESSION['login_id']);
        if ($delete) {
            return 1;
        }
    }

    function save_market()
    {
        extract($_POST);
        $data = "user_id = '{$_SESSION['login_id']}' ";
        $data .= ", name = '$name' ";
        $data .= ", price = '$price' ";
        $data .= ", quantity = '$quantity' ";
        $data .= ", valid_until = '$valid_until' ";
        $data .= ", description = '".htmlentities(str_replace("'", "&#x2019;", $description))."' ";
        if ($_FILES['photo']['tmp_name'] != '') {
            $_FILES['photo']['name'] = str_replace(["(", ")", " "], '', $_FILES['photo']['name']);
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['photo']['name'];
            $move = move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/uploads/'.$fname);
            $data .= ", photo = '$fname' ";
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO product set ".$data);
        } else {
            $save = $this->db->query("UPDATE product set ".$data." where id=".$id);
        }
        if ($save) {
            return 1;
        }
    }

    function delete_market()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM product where id = ".$id) ;
        if ($delete) {
            return 1;
        }
    }

    function save_survey()
    {
        extract($_POST);
        $data = "user_id = '{$_SESSION['login_id']}' ";
        $data .= ", tracer_version = '$tracer_version' ";
        $data .= ", grad_course = '$grad_course' ";
        $data .= ", grad_course_status = '$grad_course_status' ";

        if($employment_status == 'true') {
            $data .= ", cur_employed = 'EMPLOYED' ";
            $data .= ", cur_job = '$cur_job' ";
            $data .= ", cur_job_company = '$cur_job_company' ";
            $data .= ", cur_job_find = '$cur_job_find' ";
            $data .= ", cur_job_status  = '$cur_job_status ' ";
            $data .= ", cur_job_salary = '$cur_job_salary' ";
            $data .= ", cur_job_start = '$cur_job_start' ";
            $data .= ", cur_job_end = '$cur_job_end' ";
            $data .= ", award_job = '$award_job' ";
            if(isset($cur_job_other)) {
                $data .= ", cur_job_other = '$cur_job_other' ";
            }
        } else {
            $data .= ", cur_employed = 'UNEMPLOYED' ";
            $data .= ", cur_unemployed_reason = '$cur_unemployed_reason' ";
        }

        if($firstJobStatus == 'false') {
            $data .= ", first_job  = '$first_job ' ";
            $data .= ", first_job_status   = '$first_job_status  ' ";
            if(isset($first_job_other)) {
                $data .= ", first_job_other  = '$first_job_other ' ";
            }
        } else if ($firstJobStatus == 'true' && $employment_status == 'true'){
            $data .= ", first_job  = '$cur_job ' ";
            $data .= ", first_job_status   = '$cur_job_status  ' ";
            if(isset($cur_job_other)) {
                $data .= ", first_job_other  = '$cur_job_other ' ";
            }
        }

        $save = $this->db->query("INSERT INTO tracer_survey set ".$data);
        if ($save) {
            return 1;
        }
    }
}