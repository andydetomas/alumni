<style>
    #portfolio .img-fluid {
        width: calc(100%);
        height: 30vh;
        z-index: -1;
        position: relative;
        padding: 1em;
    }

    .gallery-list {
        cursor: pointer;
        border: unset;
        flex-direction: inherit;
    }

    .gallery-img, .gallery-list .card-body {
        width: calc(50%)
    }

    .gallery-img img {
        object-fit: cover;
        border-radius: 5px;
        min-height: 50vh;
        max-width: calc(100%);
    }

    span.hightlight {
        background: yellow;
    }

    .carousel, .carousel-inner, .carousel-item {
        min-height: calc(100%)
    }

    header.masthead, header.masthead:before {
        min-height: 50vh !important;
        height: 50vh !important
    }

    .row-items {
        position: relative;
    }

    .card-left {
        left: 0;
    }

    .card-right {
        right: 0;
    }

    .rtl {
        direction: rtl;
    }

    .gallery-text {
        justify-content: center;
        align-items: center;
    }

    .masthead {
        min-height: 23vh !important;
        height: 23vh !important;
    }

    .masthead:before {
        min-height: 23vh !important;
        height: 23vh !important;
    }

</style>
<header class="masthead">
    <div class="container-fluid h-100">
        <div class="row h-75 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end mb-4 page-title">
                <h3 class="text-white">Featured Post</h3>
                <div class="col-md-12 mb-5 justify-content-center"></div>
            </div>

        </div>
    </div>
</header>
<div class="container-fluid mt-3 pt-2">

    <div class="row-items">
        <div class="col-lg-12">
            <div class="row">
                <?php
                $rtl = '';
                $ci = 0;
                $gallery = $conn->query("SELECT * from gallery order by id desc");
                while ($row = $gallery->fetch_assoc()):
                    if ($ci%2 == 0) {
                        $rtl = 'rtl';
                    } else {
                        $rtl = '';
                    }
                    $ci++;
                    ?>
                    <div class="col-md-6">
                        <div class="card gallery-list <?php echo $rtl ?>" data-id="<?php echo $row['id'] ?>">
                            <div class="gallery-img card-img-top">
                                <img src="admin/assets/uploads/gallery/<?php echo($row['path'])?>" alt="">
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center justify-content-center text-center h-100">
                                    <div class="">
                                        <div>
                                            <span class="truncate"
                                                  style="font-size: inherit;"><small><?php echo ucwords($row['about']) ?></small></span>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>


<script>
    // $('.card.gallery-list').click(function(){
    //     location.href = "index.php?page=view_gallery&id="+$(this).attr('data-id')
    // })
    $('.book-gallery').click(function () {
        uni_modal("Submit Booking Request", "booking.php?gallery_id=" + $(this).attr('data-id'))
    })
    $('.gallery-img img').click(function () {
        viewer_modal($(this).attr('src'))
    })

</script>