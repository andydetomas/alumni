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
                        <b>List of Alumni</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="">Avatar</th>
                                <th class="">Name</th>
                                <th class="">Course Graduated</th>
                                <th class="">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $alumni = $conn->query("SELECT a.*,c.course,Concat(a.lastname,', ',a.firstname,' ',a.middlename) as name, u.status from alumnus_bio a inner join users u on u.id=a.user_id inner join courses c on c.id = a.course_id order by u.id desc");
                            while ($row = $alumni->fetch_assoc()):

                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center">
                                        <div class="avatar">
                                            <img src="assets/uploads/<?php echo $row['avatar'] ?>" class="" alt="">
                                        </div>
                                    </td>
                                    <td class="">
                                        <p><?php echo ucwords($row['name']) ?></p>
                                    </td>
                                    <td class="">
                                        <p><?php echo $row['course'] ?></p>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($row['status'] == 'ACTIVE'): ?>
                                            <span class="badge badge-primary">Verified</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Not Verified</span>
                                        <?php endif; ?>

                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary view_alumni" type="button"
                                                data-id="<?php echo $row['id'] ?>">View
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

    .avatar {
        display: flex;
        border-radius: 100%;
        width: 100px;
        height: 100px;
        align-items: center;
        justify-content: center;
        border: 3px solid;
        padding: 5px;
    }

    .avatar img {
        max-width: calc(100%);
        max-height: calc(100%);
        border-radius: 100%;
    }
</style>
<script>
    $(document).ready(function () {
        $('table').dataTable()
    })

    $('.view_alumni').click(function () {
        uni_modal("Bio", "view_alumni.php?id=" + $(this).attr('data-id'), 'mid-large')

    })
</script>