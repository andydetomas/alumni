<style>
    .collapse a {
        text-indent: 10px;
    }

    nav#sidebar {
        background: url(assets/uploads/background_admin.jpg) !important
    }
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark'>

    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i
                        class="fa fa-home"></i></span> Home</a>
        <a href="index.php?page=market" class="nav-item nav-market"><span class='icon-field'><i class="fa fa-user"></i></span>
            Marketplace </a>
        <a href="index.php?page=gallery" class="nav-item nav-gallery"><span class='icon-field'><i
                        class="fa fa-image"></i></span> Featured Post </a>
        <a href="index.php?page=tracer" class="nav-item nav-tracer"><span class='icon-field'><i class="fa fa-book"></i></span>
            Tracer Study</a>
        <a href="index.php?page=courses" class="nav-item nav-courses"><span class='icon-field'><i
                        class="fa fa-list"></i></span> Course List</a>
        <a href="index.php?page=alumni" class="nav-item nav-alumni"><span class='icon-field'><i class="fa fa-users"></i></span>
            Alumni List</a>
        <a href="index.php?page=jobs" class="nav-item nav-jobs"><span class='icon-field'><i class="fa fa-briefcase"></i></span>
            Jobs</a>
        <a href="index.php?page=events" class="nav-item nav-events"><span class='icon-field'><i
                        class="fa fa-calendar-day"></i></span> Events</a>
        <a href="index.php?page=forums" class="nav-item nav-forums"><span class='icon-field'><i
                        class="fa fa-comments"></i></span> Forum</a>
        <?php if ($_SESSION['login_type'] == 'ADMIN'): ?>
            <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i
                            class="fa fa-users"></i></span> Privileged  Users</a>
            <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i
                            class="fa fa-cogs"></i></span> System Settings</a>
        <?php endif; ?>
    </div>

</nav>
<script>
    $('.nav_collapse').click(function () {
        console.log($(this).attr('href'))
        $($(this).attr('href')).collapse()
    })
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
