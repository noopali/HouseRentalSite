<?php
require "database.php";
class Crud{
    public $con = null;
    public function __construct(){
        $db = new Database();
        $this->con = $db->getConnection();
    }

public function insert($table,$item_arr){
    $statement =" insert into ".$table;
    $cols = "(";
    $vals ="values(";
    foreach($item_arr as $k => $v){
        $cols .= $k.",";
        $vals .= "'".$v."',";
    }
    $cols = rtrim($cols,",");
    $vals = rtrim($vals,",");
    $cols.= ")";
    $vals.=")";

    $insert = $statement.$cols.$vals;
    $query = mysqli_query($this->con,$insert);
}

public function selectNoCondition($table){
   $select = "select * from ".$table;
    $query = mysqli_query($this->con,$select);
    // if($query){
    //     $row = mysqli_fetch_assoc($query);
    //     //echo $row["name"];
    //     echo "sucessfully selected";
    //     
        
    // }
    return $query;
}
public function selectCondition($table,$column,$condition){
    $select = "select {$column} from {$table} where {$condition}";
    $query = mysqli_query($this->con,$select);
    return $query;
}
public function selectAll($table,$operator,$key,$value){ //selects all from table with condition
    $select = "select * from {$table} where {$key} {$operator} '{$value}'";
    $query = mysqli_query($this->con,$select);
   return $query;
}
public function select($table,$column,$condition,$key,$value){ //selects specific column  from table with condition
    $select = "select {$column} from {$table} where {$key} {$condition} '{$value}'";
    $query = mysqli_query($this->con,$select);
    return $query;
}

public function updateOne($table,$column,$updatedValue,$key,$operator,$value){

    $updateQuery = "update ".$table. " set ".$column." = " .$updatedValue." where ".$key.$operator.$value;
    $query = mysqli_query($this->con,$updateQuery);
    echo $updateQuery;
  
}
public function updateMultiple($table, $update_arr, $key, $operator, $value) {
    $updateQuery = "UPDATE `$table` SET ";
    $count = count($update_arr);
    $i = 0;

    foreach ($update_arr as $column => $updatedValue) {
        // Escape the values to prevent SQL injection
        $column = mysqli_real_escape_string($this->con, $column);
        $updatedValue = mysqli_real_escape_string($this->con, $updatedValue);

        // Enclose the string values in single quotes in the SQL query
        $updatedValue = "'" . $updatedValue . "'";

        $updateQuery .= "`$column` = $updatedValue";

        if ($i < $count - 1) {
            $updateQuery .= ",";
        }
        $i++;
    }

    // Add the WHERE clause to the query
    $key = mysqli_real_escape_string($this->con, $key);
    $value = mysqli_real_escape_string($this->con, $value);
    $value = "'" . $value . "'";
    $updateQuery .= " WHERE `$key` $operator $value";

    // Print the generated query for debugging purposes
    echo $updateQuery;

    $query = mysqli_query($this->con, $updateQuery);

    // Add error handling here if needed
}
public function updateAll($table,$update_arr,$key,$value){  

    $update = "update ".$table. " set ";
    $count = count($update_arr);
    $i=0;
    foreach($update_arr as $key => $value){
        $update .= $key." = '{$value}' ";
        if($i<$count-1){
            $update .= ",";
        }
        $i++;
  
    }
    $update .="where {$key} = '{$value}'";
  $query = mysqli_query($this->con,$update);
}

public function delete($table,$key,$value){
    $delete = "delete from ".$table." where ".$key." = ".$value;

    $query = mysqli_query($this->con,$delete);
    if($query)
    {
        echo "delete success";

    }
}
public function Exists($table,$key,$value){
    $sql = "select * from ". $table." where ".$key." = '{$value}'";
    $result = mysqli_query($this->con,$sql);
    if($result){
        $count = mysqli_num_rows($result);
        if($count>0){
            return true;
        }
        else{
            return false;
        }
    }
}

public function getColumnNames($table){
    $query = "SHOW COLUMNS FROM $table";
    $result = mysqli_query($this->con, $query);
    
    return $result;
}
public function selectJoin($table, $joinTable, $joinCondition, $selectColumns) {
    $selectCols = implode(", ", $selectColumns);

    $query = "SELECT $selectCols FROM $table INNER JOIN $joinTable ON $joinCondition";

    $result = mysqli_query($this->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      return $result;
    } else {
      return false;
    }
}


public function selectJoinCondition($table, $joinTable, $joinCondition,$condition, $selectColumns) {
    $selectCols = implode(", ", $selectColumns);

    $query = "SELECT $selectCols FROM $table INNER JOIN $joinTable ON $joinCondition where $condition";

    $result = mysqli_query($this->con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      return $result;
    } else {
      return false;
    }
}


function multiJoinQuery($tables, $joins, $conditions,$selectColumns)
{
    $selectCols = implode(", ", $selectColumns);
    // Prepare the query
    $query = "SELECT $selectCols  FROM $tables[0]";
    
    // Generate the join statements
    for ($i = 1; $i < count($tables); $i++) {
        $query .= " JOIN $tables[$i] ON {$joins[$i-1]} ";
    }
    
    // Add the conditions if provided
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }
    // Execute the query
    $statement = mysqli_query($this->con,$query);
    return $statement;
}
function leftOuterJoin($select, $tables, $joinConditions, $conditions) {
    // Construct the join clauses
    $joinClauses = [];
    $selectcols = implode(", ", $select);
    foreach ($joinConditions as $key => $condition) {
      $joinClauses[] = "LEFT OUTER JOIN {$tables[$key +1]} ON $condition";
    }
  
    // Construct the WHERE clause
    $whereClause = !empty($conditions) ? "WHERE $conditions" : "";
  
    // Construct the SQL query
    $query = "SELECT $selectcols FROM $tables[0] " . implode(" ", $joinClauses) . " $whereClause";
    
    // // Perform the query
    $result = mysqli_query($this->con, $query);
    if($result && mysqli_num_rows($result) > 0){
        return $result;
    }
   else{
    return false;
   }
  }
  
  
}

