<?php
// 'recipe' object
class Recipe{
 
    // database connection and table name
    private $conn;
    private $table_name = "recipes";
 
    // object properties
    public $id;
    public $name;
    public $prep_time;
    public $difficulty;
    public $vegetarian;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
 
// create new user record
function create(){
     // insert query
    $query = "INSERT INTO " . $this->table_name . "
            SET
                name = :name,
                prep_time = :prep_time,
                difficulty = :difficulty,
                vegetarian = :vegetarian";

     // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->prep_time=htmlspecialchars(strip_tags($this->prep_time));
    $this->difficulty=htmlspecialchars(strip_tags($this->difficulty));
    $this->vegetarian=htmlspecialchars(strip_tags($this->vegetarian));
 
    // bind the values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':prep_time', $this->prep_time);
    $stmt->bindParam(':difficulty', $this->difficulty);
    $stmt->bindParam(':vegetarian', $this->vegetarian);

    // execute the query, also check if query was successful
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
 
// list of Recipes in the database
function listRecipes(){
 
    // query to check the result
    $query = "SELECT recipes.id, recipes.name, recipes.prep_time, recipes.difficulty, recipes.vegetarian,COUNT(rating.id) as no_of_rating,SUM(rating.rating) as total FROM recipes INNER JOIN rating ON rating.recipe_id = recipes.id GROUP BY recipes.id ";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if result exists
    if($num>0){
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        return $result;
    }
 
    // return false if result does not exist in the database
    return false;
}
// list of Recipes in the database
function getRecipe($id){
 
    // query to check the result
    $query = "SELECT recipes.id, recipes.name, recipes.prep_time, recipes.difficulty, recipes.vegetarian,COUNT(rating.id) as no_of_rating,SUM(rating.rating) as total FROM recipes INNER JOIN rating ON rating.recipe_id = recipes.id WHERE recipes.id =".$id;
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if result exists
    if($num>0){
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        return $result;
    }
 
    // return false if result does not exist in the database
    return false;
}
// list of Recipes in the database
function deleteRecipe($id){
 
    // query to check the result
    $query = "DELETE FROM `recipes` WHERE `recipes`.`id` =".$id;
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // execute the query
    $stmt->execute();
 
    // return false if result does not exist in the database
    return true;
}
// update a user record
public function update(){
 
    // if no posted password, do not update the password
    $query = "UPDATE " . $this->table_name . "
            SET
                name = :name,
                prep_time = :prep_time,
                difficulty = :difficulty,
                vegetarian = :vegetarian
            WHERE id = :id";
 
    // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->prep_time=htmlspecialchars(strip_tags($this->prep_time));
    $this->difficulty=htmlspecialchars(strip_tags($this->difficulty));
    $this->vegetarian=htmlspecialchars(strip_tags($this->vegetarian));
 
    // bind the values from the form
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':prep_time', $this->prep_time);
    $stmt->bindParam(':difficulty', $this->difficulty);
    $stmt->bindParam(':vegetarian', $this->vegetarian);
 
    // unique ID of record to be edited
    $stmt->bindParam(':id', $this->id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
}