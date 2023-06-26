<?php
    include('admin/db_connect.php');
    if(!$conn) {
        header('location:error-page.php');
    } else {
        session_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_assoc();

        foreach ($query as $key => $value) {
            $_SESSION['system'][$key] = $value;
        }

        $qry_tracer = $conn->query("SELECT * FROM tracer_version WHERE status='ACTIVE' ORDER BY id DESC LIMIT 1")->fetch_assoc();
        header("Cache-Control: no cache");
        date_default_timezone_set('Asia/Manila');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include('header.php') ?>

<style>
    header.masthead {
        background: url(admin/assets/uploads/<?php echo $_SESSION['system']['cover_img']?>);
        background-repeat: no-repeat;
        background-size: cover;
    }

    header.masthead, header.masthead:before {
        min-height: 60vh !important;
        height: 60vh !important
    }

    #viewer_modal .btn-close {
        position: absolute;
        z-index: 999999;
        /*right: -4.5em;*/
        background: unset;
        color: white;
        border: unset;
        font-size: 27px;
        top: 0;
        right: 0;
    }

    #viewer_modal .modal-dialog {
        width: 80%;
        max-width: unset;
        height: calc(90%);
        max-height: unset;
    }

    #viewer_modal .modal-content {
        background: black;
        border: unset;
        height: calc(100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #viewer_modal img, #viewer_modal video {
        max-height: calc(100%);
        max-width: calc(100%);
    }

    body, footer {
        background: #000000e6 !important;
    }

    a.jqte_tool_label.unselectable {
        height: auto !important;
        min-width: 4rem !important;
        padding: 5px
    }

    .select2-container .select2-selection--single {
        height: 37px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 2px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 2;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
    }

    .switch_page {
        cursor: pointer;
    }

    .badge-custom {
        color: white;
        position: absolute;
        font-size: 50%;
    }

</style>

<body id="page-top">
<!-- Navigation-->
<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger"
           href="./">WMSU <?php echo preg_replace('~\S\K\S*\s*~u', '', $_SESSION['system']['name']) ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link js-scroll-trigger nav-home nav-" href="index.php?page=home">Home</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger nav-alumni_list" href="index.php?page=alumni_list">Alumni</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger nav-gallery" href="index.php?page=gallery">Featured Post</a></li>
                <?php if (isset($_SESSION['login_id'])): ?>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger nav-market" href="index.php?page=market">Marketplace</a></li>
                    <?php if ($_SESSION['login_type'] == 'ALUMNI' && isset($qry_tracer['id'])): ?> <!-- Only show trace for students and if there is a new version release -->
                    <li class="nav-item"><a class="nav-link js-scroll-trigger nav-tracer" href="index.php?page=tracer">Tracer Study
                            <span class="badge bg-danger badge-pill badge-custom">!</span></a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger nav-careers" href="index.php?page=careers">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger nav-forum" href="index.php?page=forum">Forums</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link js-scroll-trigger nav-about" href="index.php?page=about">About</a></li>
                <?php if (! isset($_SESSION['login_id'])): ?>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" id="login">Login</a></li>
                <?php else: ?>
                    <li class="nav-item">
                        <div class=" dropdown mr-4">
                            <a href="#" class="nav-link js-scroll-trigger" id="account_settings" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_first_name'] ?> <i
                                    class="fa fa-angle-down"></i></a>
                            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -5.5em;">
                                <?php if ($_SESSION['login_type'] != 'ALUMNI'): ?>
                                <a class="dropdown-item switch_page" id="switch_page"><i class="fa fa-table"></i> Admin Dashboard</a>
                                <?php endif; if (isset($_SESSION['bio']['id'])): ?>
                                <a class="dropdown-item" href="index.php?page=my_account" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : "home";
include $page.'.php';
?>

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <div id="delete_content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-arrow-right"></span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <img src="" alt="">
        </div>
    </div>
</div>
<div id="preloader"></div>
<footer class=" py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mt-0 text-white">Contact us</h2>
                <hr class="divider my-4"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                <a class="d-block"
                   href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="small text-center text-muted"><?php echo $_SESSION['system']['name'] ?> | Jerrick Bucar , Kiev
            Xandri Perez, Kristel Mar Watiwat | Capstone Project 2022 - 2023
        </div>
    </div>
</footer>

<?php include('footer.php') ?>
</body>
<script type="text/javascript">
    $('#login').click(function () {
        uni_modal("Login", 'login.php')
    });
    $('#switch_page').click(function () {
        location.replace('admin/index.php');
    })
</script>
<script>
    $('.nav-item').click(function () {
        $($(this).attr('href')).collapse()
    })
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

<?php $conn->close() ?>

</html>
