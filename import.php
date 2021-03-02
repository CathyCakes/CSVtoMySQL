<?php
/**
 * Created by PhpStorm.
 * User: CupCakes
 * Date: 2021/02/28
 * Time: 6:03 PM
 */

//import CSV file
if (isset($_POST["import"]))
{
    $fileName = $_FILES["file"]["tmp_name"];

    //if file is not empty
    if ($_FILES["file"]["size"] > 0)
    {
        //when not properly recognizing the line endings on Macintosh
        ini_set('auto_detect_line_endings',TRUE);

        //create CSV file handler
        if (($handle = fopen($fileName, "r")) !== FALSE)
        {
            $firstLine = true; //fgets($file); --or could read first line for no reason instead to skip header line

            //continue for each line in CSV file
            while (($column = fgetcsv($handle, 10000, ";")) !== FALSE)
            {
                //skip header line
                if (!$firstLine)
                {
                    /*CSV line data*/
                    $studentNumber = "";
                    if (isset($column[0]))
                        $studentNumber = mysqli_real_escape_string($conn, $column[0]);

                    $firstName = "";
                    if (isset($column[1]))
                        $firstName = mysqli_real_escape_string($conn, $column[1]);

                    $surname = "";
                    if (isset($column[2]))
                        $surname = mysqli_real_escape_string($conn, $column[2]);

                    $courseCode = "";
                    if (isset($column[3]))
                        $courseCode = mysqli_real_escape_string($conn, $column[3]);

                    $courseDescription = "";
                    if (isset($column[4]))
                        $courseDescription = mysqli_real_escape_string($conn, $column[4]);

                    $grade = "";
                    if (isset($column[5]))
                        $grade = mysqli_real_escape_string($conn, $column[5]);

                    /*insert CSV line data into database*/
                    $sqlInsert = "INSERT into students (studentNumber,firstName,surname,courseCode,courseDescription,grade) values (?,?,?,?,?,?)";
                    $paramType = "isssss";
                    $paramArray = array($studentNumber, $firstName, $surname, $courseCode, $courseDescription, $grade);
                    $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

                    if (!empty($insertId))
                    {
                        $type = "success";
                        $message = "CSV data imported into the database";
                    }
                    else
                    {
                        $type = "error";
                        $message = "Problem in importing CSV data";
                    }
                }
                $firstLine = false;
            }
            ini_set('auto_detect_line_endings',FALSE);
        }
    }
}