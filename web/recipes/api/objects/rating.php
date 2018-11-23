<?php
// 'rating' object
class Rating{
 
    // database connection and table name
    private $conn;
    private $table_name = "rating";
 
    // object properties
    public $id;
    public $recipe_id;
    public $rating;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// create new user record
function create(){
     // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
                recipe_id = :recipe_id,
                rating = :rating";

     // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->recipe_id=htmlspecialchars(strip_tags($this->recipe_id));
    $this->rating=htmlspecialchars(strip_tags($this->rating));

    // bind the values
    $stmt->bindParam(':recipe_id', $this->recipe_id);
    $stmt->bindParam(':rating', $this->rating);

    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
}

}