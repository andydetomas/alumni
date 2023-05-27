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
        cursor: pointer;
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
    }

    span.hightlight {
        background: yellow;
    }

    .banner {
        min-height: calc(100%)
    }
</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Welcome to WMSU <?php echo $_SESSION['system']['name']; ?></h3>
                <div class="col-md-12 mb-5 justify-content-center"></div>
            </div>
        </div>
    </div>
</header>
<div class="container mt-3 pt-2">
    <h4 class="text-center text-white">Upcoming Events</h4>
    <hr class="divider">
    <?php
    $event = $conn->query("SELECT * FROM events ORDER BY schedule asc");
    while ($row = $event->fetch_assoc()):
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['content']), $trans);
        $desc = str_replace(["<li>", "</li>"], ["", ","], $desc);
        ?>
        <div class="card event-list" data-id="<?php echo $row['id'] ?>">
            <div class='banner'>
                <?php if (! empty($row['banner'])): ?>
                    <img src="admin/assets/uploads/<?php echo($row['banner']) ?>" alt="">
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="row  align-items-center justify-content-center text-center h-100">
                    <div class="">
                        <h3><b class="filter-txt"><?php echo ucwords($row['title']) ?></b></h3>
                        <div>
                            <small>
                                <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y h:i A", strtotime($row['schedule'])) ?>
                            </small>
                        </div>
                        <hr>
                        <p class="truncate"><?php echo strip_tags($desc) ?></p>
                        <br>
                        <button class="btn btn-primary float-right read_more btn-sm" data-id="<?php echo $row['id'] ?>">Read More</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
    <?php endwhile; ?>
</div>


<script>
    $('.read_more').click(function () {
        location.href = "index.php?page=view_event&id=" + $(this).attr('data-id')
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