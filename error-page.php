<!DOCTYPE html>
<html lang="en">
<?php include('header.php') ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            background: rgba(41, 41, 41, 0.89) !important;
        }
        .page-404 .outer {
            position: absolute;
            top: 0;

            display: table;

            width: 100%;
            height: 100%;
        }
        .page-404 .outer .middle {
            display: table-cell;

            vertical-align: middle;
        }
        .page-404 .outer .middle .inner {
            width: 300px;
            margin-right: auto;
            margin-left: auto;
        }
        .page-404 .outer .middle .inner .inner-circle {
            height: 300px;
            border-radius: 50%;
            background-color: #ffffff;
        }
        .page-404 .outer .middle .inner .inner-circle:hover i {
            color: #e0e0e0!important;
            background-color: #f5f5f5;
            box-shadow: 0 0 0 15px #e0e0e0;
        }
        .page-404 .outer .middle .inner .inner-circle:hover span {
            color: #e0e0e0;
        }
        .page-404 .outer .middle .inner .inner-circle span {
            font-size: 8em;
            font-weight: 700;
            line-height: 2.2em;

            display: block;

            -webkit-transition: all .4s;
            transition: all .4s;
            text-align: center;

            color: #17a2b8;
        }
        .page-404 .outer .middle .inner .inner-status {
            font-size: 20px;

            display: block;

            margin-top: 20px;
            margin-bottom: 5px;

            text-align: center;

            color: #17a2b8;
        }
        .page-404 .outer .middle .inner .inner-button {
            /*margin-left: 30px;*/
        }
        .page-404 .outer .middle .inner .inner-detail {
            line-height: 1.4em;

            display: block;

            margin-bottom: 10px;

            text-align: center;

            color: #ffffff;
        }

    </style>
</head>
<body>
<div class="page-404">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <div class="inner-circle"><span>500</span></div>
                <span class="inner-status">Opps! Internal Server Error!</span>
                <span class="inner-detail">Unfortunately we're having trouble loading the page you are looking for. Please contact the web administrator.</span>
                <span class="inner-button"><a class="btn btn-sm btn-info col-sm-12" href="index.php">Refresh</a></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>