<?php
include 'controller/admin-validation.php';

$queryDataService = mysqli_query($connection, "SELECT* FROM type_of_service WHERE deleted_at=0 ORDER BY id DESC");
?>

<div class="wrapper flex-grow-1 container-p-y">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title">Data Service</h3>
            <div align="right" class="button-action">
                <a href="?pg=add-data-service" class="btn btn-primary">Add</a>
            </div>
            <table class="table table-bordered table-striped table-hover table-responsive mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($rowDataService = mysqli_fetch_assoc($queryDataService)) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= isset($rowDataService['service_name']) ? $rowDataService['service_name'] : '-' ?></td>
                            <td><?= isset($rowDataService['price']) ? 'Rp. ' . number_format($rowDataService['price']) : '-' ?></td>
                            <td><?= isset($rowDataService['description']) ? $rowDataService['description'] : '-' ?></td>
                            <td>
                                <a href="?pg=add-data-service&edit=<?php echo $rowDataService['id'] ?>">
                                    <button class="btn btn-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                        </svg>
                                    </button>
                                </a>
                                |
                                <a onclick="return confirm ('Apakah anda yakin akan menghapus data ini?')"
                                    href="?pg=add-data-service&delete=<?php echo $rowDataService['id'] ?>">
                                    <button class="btn btn-light">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; // End While 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>