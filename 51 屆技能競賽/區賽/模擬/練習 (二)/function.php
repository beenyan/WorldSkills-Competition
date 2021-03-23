<?php
    class DB{
        public function query($sql, $type = 0){
            $ret = [];
            $result = mysqli_query($GLOBALS['db'], $sql) or die('查詢失敗');
            if ($type == 0) {
                while ($row = mysqli_fetch_array($result)) {
                    array_push($ret, (object)$row);
                }
            } else if ($type == 1) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($ret, (object)$row);
                }
            }
            return $ret;
        }
        public function q($sql, $type = 1){
            return DB::query($sql, $type);
        }
        public function work($sql){
            mysqli_query($GLOBALS['db'], $sql);
        }
        public function insert($form, $data, $show = 0) {
            $data = (array)$data;
            $keys = "`".join(array_keys($data),'`,`')."`";
            $vals = "'".join(array_values($data),"','")."'";
            if ($show) pri("INSERT INTO `$form` ($keys) VALUES ($vals)");
            else DB::work("INSERT INTO `$form` ($keys) VALUES ($vals)");
            
        }
    }
    function let($name, $val) { echo "<script>let $name = $val</script>"; }
    function alert($Text) { echo "<script>alert('$Text')</script>"; }
    function href($url) { header("Location:$url"); exit();}
    function out() { let('Get', json_encode($_GET)); let('Post', json_encode($_POST)); }
    function par($string) { return json_decode($string); }
    function str($data) { return json_encode($data); }
    function pri($data) { print_r($data); echo '<br>'; }
    function remove_utf8_bom($text) { // 刪除 bom
        $bom = pack('H*','EFBBBF');
        return preg_replace("/^$bom/", '', $text);
    }
?>