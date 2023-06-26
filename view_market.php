<?php
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM product where id= ".$_GET['id']);
    foreach ($qry->fetch_array() as $k => $val) {
        $$k = $val;
    }

    $commits = $conn->query("SELECT * FROM product_commits where product_id=$id and status='RESERVED'");
    $row_commits = $commits->fetch_all(MYSQLI_ASSOC);
    $available_quantity = $quantity-array_sum(array_column($row_commits, 'quantity'));
    $my_commits = array_filter($row_commits, function ($var) {
        return ($var['user_id'] == $_SESSION['login_id']);
    });
    $my_reservations = array_sum(array_column($my_commits, 'quantity'));
    //echo("<script>console.log('PHP OUTPUT: " . json_encode($row_commits) . "');</script>");
}
?>
<style type="text/css">
    .imgs {
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }

    .imgs img {
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }

    #imagesCarousel, #imagesCarousel .carousel-inner, #imagesCarousel .carousel-item {
        height: 40vh !important;
        background: black;

    }

    #imagesCarousel {
        margin-left: unset !important;
    }

    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
        margin-top: unset;
        margin-bottom: unset;
    }

    #imagesCarousel img {
        width: calc(100%) !important;
        height: auto !important;
        /*max-height: calc(100%)!important;*/
        max-width: calc(100%) !important;
        cursor: pointer;
    }

    #banner {
        display: flex;
        justify-content: center;
    }

    #banner img {
        max-width: calc(100%);
        max-height: 50vh;
        cursor: pointer;
    }

    <?php if(!empty($photo)): ?>
    header.masthead {
        background: url(admin/assets/uploads/<?php echo $photo ?>);
        background-repeat: no-repeat;
        background-size: cover;
    }

    <?php endif; ?>
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-4 align-self-end mb-4 pt-2 page-title">
                <h4 class="text-center text-white"><b><?php echo ucwords($name) ?></b></h4>
                <hr class="divider my-4"/>
                <p class="text-center text-white mt-n2"><small><i class="fa fa-calendar"></i> Reserve until <?php echo date("F d, Y", strtotime($valid_until)) ?></small></p>
                <p class="text-center text-white mt-n3"><small><i class="fa fa-cart-plus"></i> Quantity Available: <?php echo $available_quantity > 0 ? $available_quantity : 'SOLD OUT' ?></small></p>
                <p class="text-center text-white mt-n3"><small><i class="fa fa-tag"></i> PHP <?php echo $price ?></small></p>
            </div>
        </div>
    </div>
</header>
<section></section>
<div class="container">
    <div class="col-lg-12">
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" id="content">
                        <?php if (isset($_SESSION['login_id']) && $_SESSION['login_type'] == 'ALUMNI'): ?>
                        <h6 class="text-info">My Reservations: <?php echo empty($my_reservations) ? "No order placed yet" : $my_reservations. " pc/s" ?></h6>
                        <hr>
                        <?php endif; ?>
                        <p class="mt-5"><?php echo html_entity_decode($description); ?></p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php if (isset($_SESSION['login_id']) && $_SESSION['login_type'] == 'ALUMNI'): ?>
                                <?php if (!empty($my_reservations)): ?>
                                    <button class="btn btn-danger" id="cancel_reserve" data-id="<?php echo $_GET['id'] ?>" type="button">Cancel My Order</button>
                                    <button class="btn btn-primary" id="reserve" data-id="<?php echo $_GET['id'] ?>" type="button">Reserve Another?</button>
                                <?php else: ?>
                                <button class="btn btn-primary" id="reserve" data-id="<?php echo $_GET['id'] ?>" type="button">Reserve Now</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#imagesCarousel img,#banner img').click(function () {
        viewer_modal($(this).attr('src'))
    });
    $('#cancel_reserve').click(function () {
        _conf("Are you sure you want to cancel all your orders?", "cancel_reserve", [<?php echo $id ?>], 'mid-large')
    });
    $('#reserve').click(function () {
        uni_modal("Merch Reservation", "manage_market.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    function cancel_reserve($id) {
        start_load();
        $.ajax({
            url: 'admin/ajax.php?action=delete_reserve',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Orders are successfully cancelled", 'success');
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
