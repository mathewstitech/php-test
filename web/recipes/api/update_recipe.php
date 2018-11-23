<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// required to encode json web token
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
 
// files needed to connect to database
include_once '../config/database.php';
include_once 'objects/recipe.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate recipe object
$recipe = new Recipe($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
$recipeId = $_REQUEST['id'];
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// if jwt is not empty
if($jwt){
 
    // if decode succeed, show recipe details
    try {
 
        // set recipe property values
		$recipe->name = $data->name;
		$recipe->prep_time = $data->prep_time;
		$recipe->difficulty = $data->difficulty;
		$recipe->vegetarian = $data->vegetarian;
		$recipe->id =  $recipeId;
		 
		// create the product
		if($recipe->update()){
		    // we need to re-generate jwt because user details might be different
			$token = array(
			   "iss" => $iss,
			   "aud" => $aud,
			   "iat" => $iat,
			   "nbf" => $nbf,
			   "data" => array(
			       "id" => $recipe->id,
			       "name" => $recipe->name,
      		   )
			);
			$jwt = JWT::encode($token, $key);
			 
			// set response code
			http_response_code(200);
			 
			// response in json format
			echo json_encode(
			        array(
			            "message" => "Recipe was updated.",
			        )
			    );
		}
		 
		// message if unable to update user
		else{
		    // set response code
		    http_response_code(401);
		 
		    // show error message
		    echo json_encode(array("message" => "Unable to update Recipe."));
		}
    }
 
    // if decode fails, it means jwt is invalid
	catch (Exception $e){
	 
	    // set response code
	    http_response_code(401);
	 
	    // show error message
	    echo json_encode(array(
	        "message" => "Access denied.",
	        "error" => $e->getMessage()
	    ));
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