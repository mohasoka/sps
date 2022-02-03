<?php
class DB
{
    //properties 
    private const HOST_NAME = "localhost";
    private const USER_NAME = "root";
    private const PASSWORD = "";
    private const DB_NAME = "test";
    protected $connection = FALSE ;
    //===================================CONSTRUCTER============================================================
    protected function __construct(){
        $this -> connection= @mysqli_connect (self::HOST_NAME , self::USER_NAME , self::PASSWORD , self::DB_NAME);     
    }
    //=======================================METHODS============================================================
    final protected function select( $sqlQuery ){
        $result = @mysqli_query( $this->connection , "SELECT ".$sqlQuery );
        if (!$result)
            return False;
        $data = mysqli_fetch_all ( $result , MYSQLI_ASSOC );
        mysqli_free_result($result);
        return $data;
    }
    final protected function close(){
        if($this->connection)
            mysqli_close($this->connection);
    }
}

?>


   