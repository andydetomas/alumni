<!-- Masthead-->
<header class="masthead">
    <div class="container-fluid  h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end" style="background: #0000002e;">
                <h2 class="text-white mt-5 mb-5">About Us</h2>
                <div class="col-md-12 justify-content-center"></div>
            </div>
        </div>
    </div>
</header>

<section class="page-section">
    <div class="container mt-3 pt-2">
        <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>
    </div>
</section>