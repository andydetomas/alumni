<?php include 'db_connect.php' ?>
<style type="text/css">

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

    p {
        margin: unset;
    }

    #uni_modal .modal-footer {
        display: none
    }

    #uni_modal .modal-footer.display {
        display: block
    }
</style>
<div class="container-field">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        $events = $conn->query("SELECT e.user_id, a.firstname, a.lastname, a.email  
                                                    FROM `event_commits` as e, alumnus_bio as a WHERE e.user_id=a.user_id and e.event_id='{$_GET['id']}'");
                        while ($row = $events->fetch_assoc()):
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?php echo ucwords($row['firstname'])." ".ucwords($row['lastname']) ?></td>
                            <td><a class="d-block" href="mailto:<?php echo $row['email']?>"><?php echo $row['email'] ?></a></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer display">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
