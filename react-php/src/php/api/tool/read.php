<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../models/Tool.php");

//instantiate post
$tool = new Tool();

//set filter params
if (isset($_GET["id"])) {
    $tool->id = $_GET["id"];
}
if (isset($_GET["categoryId"])) {
    $tool->categoryId = $_GET["categoryId"];
}
if (isset($_GET["name"])) {
    $tool->name = $_GET["name"];
}       

//actually post / read data
$result = $tool->read();

$num = count($result);

if ($num > 0) {
    $tool_arr = array();

    foreach($result as &$row){
        extract($row);
        $tool_item = array(
            "id"            => $id,
            "categoryId"    => $categoryId,
            "name"          => $name,
            "image"         => $image
        );

        array_push($tool_arr, $tool_item);
    }

    echo json_encode($tool_arr);
} else {
    echo json_encode(array("message" => "No tools found."));
}
?>