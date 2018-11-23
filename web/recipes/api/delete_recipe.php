<?php

// required headers
header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
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
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
// set product property values
$recipeId = $_REQUEST['id'];
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// if jwt is not empty
if($jwt){

$recipes_list = $recipe->deleteRecipe($recipeId);
// list the recipe
if($recipes_list){
 
    // set response code
    http_response_code(200);
 
    // display message: user was created
    echo json_encode(array("message" => "Recipe was deleted"));
}
 
// message if unable to create user
else{
 
    // set response code
    http_response_code(400);
 
    // display message: No result found
    echo json_encode(array("message" => "Unable to delete Recipe."));
}

}
// show error message if jwt is empty
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user access denied
    echo json_encode(array("message" => "Access denied."));
}
?>