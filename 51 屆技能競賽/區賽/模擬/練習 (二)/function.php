<?php
    class DB{
        public function query($sql, $type = 1){
            $ret = [];
            $result = mysqli_query($GLOBALS['db'], $sql) or die('查詢失敗');
            while ($row = mysqli_fetch_array($result)) {
                array_push($ret, (object)$row);
            }
            return $ret;
        }
        public function q($sql, $type = 1){
            return DB::query($sql, $type);
        }
        public function work($sql){
            mysqli_query($GLOBALS['db'], $sql);
        }
    }
    function let($name, $val) { echo "<script>let $name = $val</script>"; }
    function alert($Text) { echo "<script>alert('$Text')</script>"; }
    function href($url) { header("Location:$url"); }
    function out() { let('Get', json_encode($_GET)); let('Post', json_encode($_POST)); }
    function par($string) { return json_decode($string); };
    function str($data) { return json_encode($data); };
?>