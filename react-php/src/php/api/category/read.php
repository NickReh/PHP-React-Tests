<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

require_once("../../models/Category.php");

//instantiate post
$category = new Category();

//set filter params
if (isset($_GET["id"])) {
    $category->id = $_GET["id"];
}
if (isset($_GET["parentCategoryId"])) {
    $category->parentCategoryId = $_GET["parentCategoryId"];
}
if (isset($_GET["name"])) {
    $category->name = $_GET["name"];
}
if (isset($_GET["hasTools"])) {
    $category->hasTools = $_GET["hasTools"];
}

//actually read data
$result = $category->read();

//get number of rows
//$num = $result->rowCount();

//get number of rows from dummy data
$num = count($result);

//loop through rows and set data correctly
if ($num > 0) {
    $category_arr = array();

    //while($row = $result->fetch(PDO::FETCH_ASSOC)){  //loop through data from database
    foreach($result as &$row) { //loop through dummy data
        extract($row);
        $category_item = array(
            "id"                => $id,
            "parentCategoryId"  => $parentCategoryId,
            "name"              => $name,
            "hasTools"          => $hasTools,
            "childCategories"   => $childCategories
        );

        array_push($category_arr, $category_item);
    }

    echo json_encode($category_arr);
} else {
    echo json_encode(array("message" => "No categories found."));
}
?>