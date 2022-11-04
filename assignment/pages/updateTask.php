<?php
session_start();
require_once("../inc/header.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $selectTable = "SELECT * FROM `items` WHERE id = '$id'";
    $dbQuery = mysqli_query($con, $selectTable);
    while ($result = mysqli_fetch_assoc($dbQuery)) {
        $data[] = $result;
    }

?>
    <div class="container mt-10">
        <div class="row">
            <div class="input-group input-group-lg mt-5">
                <form action="../handlers/update.php" method="POST">
                    <?php foreach ($data as $tasks) : ?>
                        <input type="text" name="data" class=" form-control" value="<?php echo $tasks["name"]; ?>">
                        <input type="hidden" value="<?php echo $tasks["id"]; ?>" name="id" />
                        <div class=" col-12 ml-10 mt-3 auto">
                            <button type="submit" class="btn btn-primary col-12 p-3">Add</button>
                        </div>
                    <?php endforeach; ?>

                </form>
            </div>
        </div>
    </div>
<?php } else header("location:./index.php");
require_once("../inc/footer.php"); ?>