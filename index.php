<?php

function con()
{
    $con = mysqli_connect("localhost", "root", "12345", "db_name");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    return $con;
}

/** MANAGE ACCEPT type file */
function allowTypeFile($selectAttribute, $space = false)
{
    $con = con();
    $sql = "SELECT * FROM type_file";

    if ($result = mysqli_query($con, $sql)) {
        $rowcount = mysqli_num_rows($result);
        if($rowcount > 0) {
            $data = $result;
            $arr = array();
            foreach ($data as $value) {
                $arr[] = $value[$selectAttribute];
            }
            $unique_data = array_unique($arr);
    
            if ($space) {
                return implode(", ", $unique_data);
            } else {
                return implode(",", $unique_data);
            }
        }
    }
}

/**
 * MANAGE ACCEPT type file bolean
 *
 * @param [string] $typeFile pakai getMimeType
 * @param [string] $selectAttribute
 * @return Boolean
 */
function allowTypeFileIn($typeFile, $selectAttribute)
{
    $arrayTypeFile = allowTypeFile($selectAttribute);
    $myArray = explode(',', $arrayTypeFile);
    if (in_array($typeFile, $myArray)) {
        return true;
    } else {
        return false;
    }
}

/* Example Text untuk USER */
// var_dump(allowTypeFile("for_out", true));

/* Example Boolean untuk Filter */
var_dump(allowTypeFileIn("application/pdf", "for_in"));