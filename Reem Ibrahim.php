<?php
class db{
   public $connection;
   public $query;
   public $sql;
   public function __construct(){
    $this->connection = mysqli_connect("localhost","root","","odc");
   }
   public function select($table , $column){

    $this->sql="SELECT $column FROM `$table`";
   //$query=  mysqli_querry($this->connection,"SELECT $column * FROM `$table`");
    // while($row = mysqli_fetch_assoc($query)) {
        //$data[] = $row;
    // }
     return $this;
   }
   public function andWhere($column , $compair , $value){
        $this->sql .="And `$column ` $compair '$value'"  ;
        return $this;
   }
   public function orWhere($column , $compair , $value){
    $this->sql .="OR `$column ` $compair '$value'"  ;
    return $this;
}
   public function getAll(){
    $this->query = mysqli_query($this->connection , $this->sql);
    while ($row =mysqli_fetch_assoc($this->query)) {
        $data[] = $row;
    }
    return $data;
   }

   public function getRow(){
    $this->query = mysqli_query($this->connection , $this->sql);
    $row =mysqli_fetch_assoc($this->query);
    return $row;
   }
   public function insert($table , $data){
    $column="";
    $values = "";
    foreach($data as $key => $value){
        $column .="`$key` ,";
    }
    $column= rtrim($column,",");
    $values = rtrim($values,",")
      $this->sql = "INSERT INTO `$table` ($column) VALUES ($values)" ;
      return $this;
   }
   public function excute(){
    $this->query = mysqli_query($this->connection , $this->sql);
    if(mysqli_affected_rows($this->connection) > 0){
        return true;
    }else{
        return false;
    }
   }
}