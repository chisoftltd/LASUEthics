<?php
/**
 * Created by PhpStorm.
 * researcher: 1609963
 * Date: 04/05/2017
 * Time: 18:51
 */

// Report all PHP errors (see changelog)
error_reporting(E_ALL);
ini_set('display_error', 1);

require_once 'dbconnect.php'; // include database connection script
include_once '../generate.php';

//$request_type = $_SERVER["REQUEST_METHOD"];

echo $_SERVER['REQUEST_URL'];
echo "<br>";

$urlInfo = explode("/", substr($_SERVER['REQUEST_URL'], 16));


echo $urlInfo;


// Use SWITCH case to implement the appropiate REQUEST METHOD


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["researchers"])) {
        get_researcher();
    } else {
        get_id_researcher($_GET['researchers']);
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (count($urlInfo) > 0 and count($urlInfo) < 6) {
        insert_researcher($urlInfo);
    } else {
        header("HTTP/1.0 400 Bad Reguest");
        echo json_encode($reply[0] = "Parameters must be greater than 1");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    update_researcher($urlInfo);
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    delete_researcher($urlInfo);
}


/*
switch ($request_type) {
    case 'GET': // GET case
        if (!isset($_GET["researchers"])) {
            get_researcher();
        } else {
            get_id_researcher($_GET['researchers']);
        }
        break;
    case 'POST': // POST case
        if (count($urlInfo) > 0 and count($urlInfo) < 6) {
            insert_researcher($urlInfo);
        } else {
            header("HTTP/1.0 400 Bad Reguest");
            echo json_encode($reply[0] = "Parameters must be greater than 1");
        }
        break;

    case 'PUT': //PUT case
        update_researcher($urlInfo);
        break;

    case 'DELETE':
        //DELETE case
        delete_researcher($urlInfo);
        break;

    default:

        header("HTTP/1.0 405 Method Not Allowed");
}
*/


function get_id_researcher($reseacher)
{
    global $link;
    //select case statement
    $query = "SELECT id, name, email, date FROM researchers where id = '$reseacher'";
    $reply = array();

    $result = mysqli_query($link, $query);
    trigger_error($link, E_USER_WARNING);

    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_assoc($query)) {
            $col1["Researcher ID"] = $row['id'];
            $col1['Name'] = $row['name'];
            $col1['Email'] = $row['email'];
            $col1['Date'] = $row['date'];

            $reply[] = $col1;

            header('Content Type: application/json');
            echo json_encode($reply);
        }
    } else {
        header("HTTP/1.0 204 No Content Found");
    }
}

function get_researcher()
{
    global $link;
    //select case statement
    $query = "SELECT id, name, email, date FROM researchers";
    $reply = array();

    $result = mysqli_query($link, $query);
    trigger_error($link, E_USER_WARNING);

    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_assoc($query)) {
            $col1["Researcher ID"] = $row['id'];
            $col1['Name'] = $row['name'];
            $col1['Email'] = $row['email'];
            $col1['Date'] = $row['date'];

            $reply[] = $col1;

            header('Content Type: application/json');
            echo json_encode($reply);
        }
    } else {
        header("HTTP/1.0 204 No Content Found");
    }
}

function insert_researcher($researcher)
{
    global $link;
    $password = generate();
    $pwd = "";

    for ($i = 0; $i < count($password); $i) {
        $pwd .= $password[rand(0, (count($password) - 1))];
    }

    $researcherid = $researcher[0];
    $researchername = $researcher[1];
    $researcheremail = $researcher[2];
    $researcherdate = new DateTime();

    $query = "insert into researcher(id, name, email, password, date) VALUES ('$researcherid', '$researchername', '$researcheremail', '$pwd', '$researcherdate')";

    $reply = array();
    $result = mysqli_query($link, $query);

    if (mysqli_affected_rows($result) > 0) {
        header("HTTP/1.0 201 Created Successfully");
        echo json_encode($reply[0] = "researcher registered");
    } else {
        header("HTTP/1.0 409 Conflicting, Researcher ID Exists");
        echo json_encode($reply[0] = "Researcher Exist, Please check the Researcher ID and try again");
    }
}

function delete_researcher($researcher)
{
    global $link;
    foreach ($researcher as $value) {

        $query = "delete from researcher where id='$value'";
        $result = mysqli_query($link, $query) or die(trigger_error($link, E_USER_WARNING));
        mysqli_free_result($result);
    }

    $reply = array();
    if (mysqli_affected_rows($result) > 0) {
        header("HTTP/1.0 201 Deleted Successfully");
        echo json_encode($reply[0] = "Deleted successfully");
    } else {
        header("HTTP/1.0 204 No Content Found");

    }
}

function update_researcher($researcher)
{
    global $link;


    $exp = array('id', 'na', 'em', 'pw', 'dt');
    $query = "update researcher set";

    $id = "";
    if (in_array('id', $researcher)) {
        $pos = array_search('id', $researcher);


        $query .= " id='{$researcher[$pos + 1]}' ";
        $id = $researcher[$pos + 1];
    }
    if (in_array('na', $researcher)) {
        $pos = array_search('na', $researcher);

        $query .= ", name='{$researcher[$pos + 1]}' ";
    }
    if (in_array('em', $researcher)) {
        $pos = array_search('em', $researcher);

        $query .= ", email='{$researcher[$pos + 1]}' ";
    }
    if (in_array('pw', $researcher)) {
        $pos = array_search('pw', $researcher);

        $query .= ", password='{$researcher[$pos + 1]}' ";
    }

    if (in_array('dt', $researcher)) {
        $pos = array_search('dt', $researcher);

        $query .= ", date='{$researcher[$pos + 1]}' ";
    }


    $query .= " where id='$id'";
    $response = array();
    $result = mysqli_query($link, $query) or die(trigger_error($link, E_USER_WARNING));
    if (mysqli_affected_rows($result) > 0) {
        header("HTTP/1.0 201 Modified Successfully");
        echo json_encode($reply[0] = "Modified Successfully");
    } else {
        header("HTTP/1.0 40, researcher ID Not found");
    }
}