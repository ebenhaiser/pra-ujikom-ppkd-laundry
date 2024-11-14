<?php
session_start();
include '../controller/action_users.php';
?>

<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />
    <?php include '../inc/css.php' ?>
</head>
<!-- <style>
    * {
        background-color: black;
    }
</style> -->

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include '../inc/sideBar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include '../inc/navbar.php' ?>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header fs-1">Data User</div>
                                    <div class="btn-cta d-flex justify-content-end me-4">
                                        <a href="add-user.php" class="btn btn-info">Add User</a>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['success-delete'])): ?>
                                            <div id="alert" class="alert alert-success" role="alert">Deleted Success</div>
                                        <?php endif; ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="bg-primary ">
                                                    <th class="text-white">No</th>
                                                    <th class="text-white">Level</th>
                                                    <th class="text-white">Nama</th>
                                                    <th class="text-white">Email</th>
                                                    <th class="text-white">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($rowDataUser = mysqli_fetch_assoc($sqlDataUser)):
                                                ?>
                                                    <tr>
                                                        <td><?php echo  $no++; ?></td>
                                                        <td><?php echo  $rowDataUser['nama_level'] ?></td>
                                                        <td><?php echo  $rowDataUser['name'] ?></td>
                                                        <td><?php echo  $rowDataUser['email'] ?></td>
                                                        <td>
                                                            <a href="../admin/add-user.php?edit=<?php echo $rowDataUser['id'] ?>" class="btn btn-warning btn-sm"><span class="tf-icon bx bx-pencil me-2">Edit</span></a>
                                                            <a href="../controller/action_user.php?delete=<?php echo $rowDataUser['id'] ?>" class="btn btn-danger btn-sm"><span class="tf-icon bx bx-trash me-2" onclick="return confirm('Are you sure want to delete this item?')">Delete</span></a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Footer -->
                    <?php include '../inc/footer.php' ?>
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <?php include '../inc/js.php' ?>
</body>

</html>