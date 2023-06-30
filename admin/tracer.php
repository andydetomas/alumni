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
                    <h5>Tracer Study Statistic Graphs</h5>
                    <hr>
                    <div class="col-lg-12">
                        <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
                    </div>
                    <div class="col-lg-12">
                        <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
                    </div>
                    <div class="col-lg-12">
                        <canvas id="courseChart" style="width:100%;max-width:700px"></canvas>
                    </div>
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
                borderColor: 'rgb(75, 192, 192)',
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
    const ctx1 = document.getElementById("myChart2").getContext('2d');
    const myChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ["rice", "yam", "tomato"],
            datasets: [{
                label: 'food Items',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                data: [30, 40, 20],
            }]
        },
    });
</script>
<script>
    const courseChart = document.getElementById("courseChart").getContext('2d');
    const data = {
        labels: ["rice", "yam", "tomato", "potato",
            "beans", "maize", "oil"],
        datasets: [{
            // axis: 'y',
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const myChart2 = new Chart(courseChart, {
        type: 'horizontalBar',
        data
    });
</script>