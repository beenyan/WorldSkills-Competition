<?php
    class DB{
        public $data = [];
        function __construct($sql,$type = 0) { // query
            $get = mysqli_query($GLOBALS['db'], $sql) or die('U are query is flase');
            if ($get->num_rows === 1) {
                $this->data = (object)mysqli_fetch_array($get);
                $this->length = 1;
            } else {
                while ($row = mysqli_fetch_array($get))
                    array_push($this->data, (object)$row);
                $this->length = count($this->data);
            }
        }
        public function work($sql){
            return mysqli_query($GLOBALS['db'], $sql);
        }
    }
    function alert($Text){ echo "<script>alert('$Text')</script>";}
    function res($status = 200,$statusText = '',$data = []){
        echo json_encode([
            'status'=>$status,
            'statusText' => $statusText,
            'data' => json_encode($data)
        ]);
        exit;
    }
    function cout($text){
        echo $text;
    }
    function JSget(){
        $get = json_encode($_GET);
        echo "<script>let Get = $get;</script>";
    }
?>