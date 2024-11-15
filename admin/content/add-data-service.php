<?php
require_once 'controller/connection.php';
include 'controller/admin-validation.php';

if (isset($_GET['delete'])) {
    $idDelete = $_GET['delete'];
    $query = mysqli_query($connection, "UPDATE type_of_service SET deleted_at=1 WHERE id='$idDelete'");
    header("Location: ?pg=data-service&delete=success");
} else if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM type_of_service WHERE id='$idEdit'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);

    if (isset($_POST['edit'])) {
        $service_name = $_POST['service_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $queryEdit = mysqli_query($connection, "UPDATE type_of_service SET service_name='$service_name', price='$price', description='$description' WHERE id='$idEdit'");
        header("Location: ?pg=data-service&edit=success");
    }
} else if (isset($_POST['add'])) {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $queryAdd = mysqli_query($connection, "INSERT INTO type_of_service (service_name, price, description) VALUES ('$service_name', '$price', '$description')");
    header("Location: ?pg=data-service&add=success");
}

?>

<div class="wrapper">
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title"><?= isset($_GET['edit']) ? 'Edit' : 'Add' ?> Data Customer</h3>
            <form action="" method="post">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service_name" name="service_name"
                            value="<?= isset($_GET['edit']) ? $rowEdit['service_name'] : '' ?>" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price"
                            value="<?= isset($_GET['edit']) ? $rowEdit['price'] : '' ?>" required>
                    </div>

                    <div class="col-sm-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="description" class="form-control" id="description" name="description" for="description"><?= isset($_GET['edit']) ? $rowEdit['description'] : '' ?></textarea>
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'add' ?>">
                        <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>