<?php
/**
 * Created by PhpStorm.
 * User: CupCakes
 * Date: 2021/02/14
 * Time: 11:10 PM
 */

use MySQL\MySQL;

/*Create database connection*/
require_once 'MySQL.php';
$db = new MySQL();
$conn = $db->getConnection();

/*Import CSV file*/
require_once 'import.php';

?>
<!DOCTYPE html>
<html>

<head>
    <script src="jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="error.js"></script>
</head>

<body>
<h2>Import CSV file into Mysql database & display results - PHP</h2>

<div id="response"
     class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
    <?php if(!empty($message)) { echo $message; } ?>
</div>

<div class="outer-scontainer">
    <div class="row">
        <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
            <div class="input-row">
                <label class="col-md-4 control-label">Choose CSV file</label>
                <input type="file" name="file" id="file" accept=".csv">
                <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
                <br />
            </div>
        </form>
    </div>

    <!-- Get database results & display-->
    <?php
    $sqlSelect = "SELECT * FROM students";
    $result = $db->select($sqlSelect);
    if (! empty($result))
    { ?>
        <table id="studentTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Course Code</th>
                <th>Course Description</th>
                <th>Grade</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($result as $row)
            { ?>
                <tr>
                    <td><?php  echo $row['id']; ?></td>
                    <td><?php  echo $row['studentNumber']; ?></td>
                    <td><?php  echo $row['firstName']; ?></td>
                    <td><?php  echo $row['surname']; ?></td>
                    <td><?php  echo $row['courseCode']; ?></td>
                    <td><?php  echo $row['courseDescription']; ?></td>
                    <td><?php  echo $row['grade']; ?></td>
                </tr>
            <?php
            } ?>
            </tbody>
        </table>
    <?php
    } ?>

</div>

</body>

</html>
