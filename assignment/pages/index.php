<?php
session_start();
require_once("../inc/header.php");


$selectTable = "SELECT * FROM `items`";
$dbQuery = mysqli_query($con, $selectTable);
while ($result = mysqli_fetch_assoc($dbQuery)) {
    $data[] = $result;
}

?>

<div class="container mt-10">

    <div class="row">
        <div class="input-group input-group-lg mt-5">
            <form action="../handlers/insert.php" method="POST">

                <?php if (isset($_SESSION["error"])) : ?>
                    <div class="alert alert-primary" role="alert">
                        <?php foreach ($_SESSION["error"] as $error) {
                            echo $error;
                        }  ?></div>
                <?php
                endif;
                unset($_SESSION["error"]);
                ?>

                <?php if (isset($_SESSION["success"])) : ?>
                    <div class="alert alert-primary" role="alert"> <?php echo $_SESSION["success"]; ?></div>
                <?php
                endif;
                unset($_SESSION["success"]);
                ?>

                <?php if (isset($_SESSION["error_id"])) : ?>
                    <div class="alert alert-primary" role="alert"> <?php echo $_SESSION["error_id"]; ?></div>
                <?php
                endif;
                unset($_SESSION["error_id"]);
                ?>

                <?php if (isset($_SESSION["success_id"])) : ?>
                    <div class="alert alert-primary" role="alert"> <?php echo $_SESSION["success_id"]; ?></div>
                <?php
                endif;
                unset($_SESSION["success_id"]);
                ?>

                <input type="text" name="data" class=" form-control">
                <div class="col-12 ml-10 mt-3 auto">
                    <button type="submit" class="btn btn-primary col-12 p-3">Add</button>
                </div>
            </form>



            <table class="table ">


                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">task</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)) :  foreach ($data as $tasks) : ?>
                            <tr>
                                <th scope="row"><?php echo $tasks["id"]; ?></th>
                                <td><?php echo $tasks["name"]; ?></td>
                                <td><a href="../handlers/delete.php?id=<?php echo $tasks["id"]; ?>">
                                        <button type="submit" class="btn btn-primary ">delete</button>
                                    </a></td>
                                <td>
                                  
                                    <a href="./updateTask.php?id=<?php echo $tasks["id"]; ?>">
                                        <button type="submit" class="btn btn-primary ">update</button>
                                    </a>
                                </td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once("../inc/footer.php"); ?>