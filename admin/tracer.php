<?php include 'db_connect.php' ?>
<style>
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        color: #ffffff96;
    }

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
        height: 60vh !important;
        background: black;
    }

    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
    }

    #imagesCarousel img {
        width: auto !important;
        height: auto !important;
        max-height: calc(100%) !important;
        max-width: calc(100%) !important;
    }
</style>

<div class="containe-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Tracer Study" ?>
                    <hr>

                    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
                    <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>


                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const ctx = document.getElementById("myChart").getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["sunday", "monday", "tuesday",
                "wednesday", "thursday", "friday", "saturday"],
            datasets: [{
                label: 'Last week',
                backgroundColor: 'rgba(161, 198, 247, 1)',
                borderColor: 'rgb(47, 128, 237)',
                data: [3000, 4000, 2000, 5000, 8000, 9000, 2000],
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        },
    });
</script>
<script>
    const ctx = document.getElementById("myChart2").getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["rice", "yam", "tomato", "potato",
                "beans", "maize", "oil"],
            datasets: [{
                label: 'food Items',
                backgroundColor: 'rgba(161, 198, 247, 1)',
                borderColor: 'rgb(47, 128, 237)',
                data: [30, 40, 20, 50, 80, 90, 20],
            }]
        },
    });
</script>