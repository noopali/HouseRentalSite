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
    //echo $insert;
    $query = mysqli_query($this->con,$insert);
   
    if ($query) echo "<br> inserted sucessfully";

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

public function updateOneById($table,$column,$newValue,$key,$value){

    $updateQuery = "update ".$table. " set ".$column." = " .$newValue." where ".$key." = ".$value;

    $query = mysqli_query($this->con,$updateQuery);
    echo $updateQuery;
  
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
    echo $update;
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

public function deleteAllById($table,$id){
    $delete = "delete from ".$table;
    $query = mysqli_query($this->con,$delete);
    if($query){
        echo "all data deleted";
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
    
    $columns = array();
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $columns[] = $row['Field'];
        }
    }
    return $columns;
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
}
  
    // ... your existing code ...
  