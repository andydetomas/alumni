<style>
    #portfolio .img-fluid {
        width: calc(100%);
        height: 30vh;
        z-index: -1;
        position: relative;
        padding: 1em;
    }

    span.hightlight {
        background: yellow;
    }

    .banner {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 26vh;
        width: calc(30%);
    }

    .banner img {
        width: calc(100%);
        height: calc(100%);
    }

    .event-list {
        border: unset;
        flex-direction: inherit;
    }

    .event-list .banner {
        width: calc(40%)
    }

    .event-list .card-body {
        width: calc(60%)
    }

    .event-list .banner img {
        object-fit: cover;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        min-height: 50vh;
        max-height: 50vh;
        cursor: pointer;
    }

    span.hightlight {
        background: yellow;
    }

    .banner {
        min-height: calc(100%)
    }

    header.masthead, header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h4 class="text-center text-white">Check our on sale Merch</h4>
                <p class="text-center text-white">Reserve yours now!!!</p>
                <div class="col-md-12 mb-5 justify-content-center"></div>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid mt-3 pt-2">
    <?php
    $event = $conn->query("SELECT * FROM product where valid_until >= CURDATE()");
    while ($row = $event->fetch_assoc()):
        $id = $row['id'];
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']), $trans);
        $desc = str_replace(["<li>", "</li>"], ["", ","], $desc);
        $commits = $conn->query("SELECT SUM(quantity) as quantity FROM product_commits pc where pc.product_id=".$row['id']." and pc.status='RESERVED'");
        $row_commits = $commits->fetch_assoc();
        $available_quantity = $row['quantity']-$row_commits['quantity'];
        ?>
        <div class="card event-list" data-id="<?php echo $row['id'] ?>">
            <div class='banner'>
                <?php if (! empty($row['photo'])): ?>
                    <img src="admin/assets/uploads/<?php echo($row['photo']) ?>" alt="">
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row align-items-center justify-content-center text-center h-25">
                    <div>
                        <h3><b class="filter-txt"><?php echo ucwords($row['name']) ?></b></h3>
                        <hr>
                    </div>
                </div>
                <div class="row align-items-start justify-content-start text-left h-auto">
                    <div class="d-block col-md-12 mt-n2">
                        <p><b><i class="fa fa-calendar"></i> Reserve until <?php echo date("F d, Y", strtotime($row['valid_until'])) ?></b></p>
                    </div>
                    <div class="d-block col-md-12 mt-n2">
                        <p><b><i class="fa fa-cart-plus"></i> Quantity Available: <?php echo $available_quantity > 0 ? $available_quantity : 'SOLD OUT' ?></b></p>
                    </div>
                    <div  class="d-block col-md-12 mt-n2">
                        <p><b><i class="fa fa-tag"></i> PHP <?php echo $row['price'] ?></b></p>
                    </div>
                </div>
                <div class="row align-items-center text-center h-50">
                    <larger class="truncate filter-txt"><?php echo strip_tags($desc) ?></larger>
                    <?php if($available_quantity > 0):?>
                    <div class="d-block col-md-12">
                        <button class="btn btn-primary float-right read_more btn-sm" data-id="<?php echo $row['id'] ?>">Read More</button>
                    </div>
                    <?php endIf; ?>
                </div>
        </div>
        </div>
        <br>
    <?php endwhile; ?>
</div>

<script>
    $('.read_more').click(function () {
        location.href = "index.php?page=view_market&id=" + $(this).attr('data-id')
    })
    $('.banner img').click(function () {
        viewer_modal($(this).attr('src'))
    })
    $('#filter').keyup(function (e) {
        var filter = $(this).val()
        $('.card.event-list .filter-txt').each(function () {
            var txto = $(this).html();
            txt = txto
            if ((txt.toLowerCase()).includes((filter.toLowerCase())) == true) {
                $(this).closest('.card').toggle(true)
            } else {
                $(this).closest('.card').toggle(false)
            }
        })
    })
</script>