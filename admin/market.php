<?php include('db_connect.php'); ?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>List of Merchandise</b>
                        <span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right"
                                                     href="index.php?page=manage_market" id="new_event">
					<i class="fa fa-plus"></i> New Merch
				</a></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <colgroup>
                                <col width="5%">
                                <col width="20%">
                                <col width="20%">
                                <col width="15%">
                                <col width="15%">
                                <col width="10%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="">Item</th>
                                <th class="">Description</th>
                                <th class="">Available Quantity</th>
                                <th class="">Available Until</th>
                                <th class="">Orders</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $events = $conn->query("SELECT * FROM product where valid_until >= CURDATE()");
                            while ($row = $events->fetch_assoc()):
                                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                $desc = strtr(html_entity_decode($row['description']), $trans);
                                $desc = str_replace(["<li>", "</li>"], ["", ","], $desc);
                                $commits = $conn->query("SELECT SUM(quantity) as quantity FROM product_commits pc where pc.product_id=".$row['id']." and pc.status='RESERVED'");
                                $row_commits = $commits->fetch_assoc();
                                $available_quantity = $row['quantity']-$row_commits['quantity'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p><b><?php echo ucwords($row['name']) ?></b></p>
                                    </td>
                                    <td>
                                        <p class="truncate"><?php echo strip_tags($desc) ?></p>
                                    </td>
                                    <td>
                                        <p class="text-center"><?php echo $available_quantity ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo date("M d, Y h:i A", strtotime($row['valid_until'])) ?></p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_order" type="button"
                                                data-id="<?php echo $row['id'] ?>">View List
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_market" type="button"
                                                data-id="<?php echo $row['id'] ?>">View
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary edit_market" type="button"
                                                data-id="<?php echo $row['id'] ?>">Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete_market" type="button"
                                                data-id="<?php echo $row['id'] ?>">Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>

</div>
<style>

    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        max-width: 100px;
        max-height:: 150px;
    }
</style>
<script>
    $(document).ready(function () {
        $('table').dataTable()
    })

    $('.view_market').click(function () {
        window.open("../index.php?page=view_market&id=" + $(this).attr('data-id'))

    })
    $('.edit_market').click(function () {
        location.href = "index.php?page=manage_market&id=" + $(this).attr('data-id')

    })
    $('.delete_market').click(function () {
        _conf("Are you sure to delete this Item?", "delete_market", [$(this).attr('data-id')])
    })
    $('.view_order').click(function () {
        uni_modal("View Orders", "view_order.php?id=" + $(this).attr('data-id'), 'large')
    })

    function delete_market($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_market',
            method: 'POST',
            data: {id: $id},
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>