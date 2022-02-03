<?php
require_once("DB.php");
final class Message extends DB
{
    private $errorPath = 'http://localhost:81/%d8%a7%d9%84%d9%85%d8%af%d8%b1%d8%b3%d8%a9%20%d8%a7%d9%84%d8%b3%d9%88%d8%b1%d9%8a%d8%a9%20%d8%a7%d9%84%d8%ae%d8%a7%d8%b5%d8%a9/error/error.php';

    public function __construct()
    {
        parent::__construct();
        if (!$this->connection) {
            header("location:" . $this->errorPath);
        }
    }
    final private function insert($sqlQuery)
    {
        $result = @mysqli_query($this->connection, "INSERT INTO " . $sqlQuery);
        return $result;
    }
    public function addMessage($id, $content)
    {
        $id = mysqli_real_escape_string($this->connection, $id);
        $content = mysqli_real_escape_string($this->connection, $content);
        $sqlQuery = "message (`fr`,`content`) value('$id','$content')";
        if($this->insert($sqlQuery)){
            
            return array(TRUE,'تم ارسال الرسالة ');
        }
        
        return array(False,'لم يتم ارسال الرسالة');
    }
}

