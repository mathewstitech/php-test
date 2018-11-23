<?php

// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// files needed to connect to database
include_once '../config/database.php';
include_once 'objects/recipe.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$recipe = new Recipe($db);

// set product property values
$recipeId = $_REQUEST['id'];

$recipes_list = $recipe->getRecipe($recipeId);
$new_array = array();
foreach ($recipes_list as $key => $titleData) {
    $new_array[$key]['id']  = $titleData['id'];
    $new_array[$key]['name']  = $titleData['name'];
    $new_array[$key]['prep_time']  = $titleData['prep_time']." Min";
    if($titleData['difficulty']==1) {
        $new_array[$key]['difficulty']  = "Level 1";
    } elseif ($titleData['difficulty']==2) {
        $new_array[$key]['difficulty']  = "Level 2";
    } elseif ($titleData['difficulty']==3) {
        $new_array[$key]['difficulty']  = "Level 3";
    }
    if($titleData['vegetarian'] ==1){
        $new_array[$key]['vegetarian']  = "Vegetarian";
    } else {
        $new_array[$key]['vegetarian']  = "Non Vegetarian";
    }
    $new_array[$key]['rating'] = $titleData['total']/$titleData['no_of_rating'];
    
 }
// list the recipe
if($recipes_list){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("recipe" => $new_array));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: No result found
    echo json_encode(array("message" => "No result found"));
}
?>