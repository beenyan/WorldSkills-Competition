<?php
    class DB {
        public function q($col, $form, $sql = 1, $type = 0) {
            $ret = [];
            $data = mysqli_query($GLOBALS['db'],"SELECT $col FROM $form WHERE $sql") or die('Select fail');
            if ($type == 0) {
                while ($row = mysqli_fetch_array($data)) {
                    array_push($ret, (object)$row);
                }
            } else if ($type == 1) {
                while ($row = mysqli_fetch_assoc($data)) {
                    array_push($ret, (object)$row);
                }
            }
            return $ret;
        }
        public function work($sql) {
            mysqli_query($GLOBALS['db'],$sql);
        }
        public function insert($form, $key, $val = '', $show = 0) {
            $val = ($val == ''? $key: $val);
            $keys = "`".join(array_keys((array)$key),'`,`')."`";
            $vals = "'".join(array_values((array)$val),"','")."'";
            if ($show) pri("INSERT INTO `$form` ($keys) VALUES ($vals)");
            else DB::work("INSERT INTO `$form` ($keys) VALUES ($vals)");
        }
    }
    function par($string) { return json_decode($string); }
    function str($data) { return json_encode($data); }
    function alert($str){ echo "<script> alert('$str'); </script>"; }
    function href($url,$test = '') {
        if ($text != '') alert($text);
        header("Location:$url");
        exit();
    }
    function pri($data) {
        print_r($data);
        echo '<br>';
        echo "<style> body{white-space: break-spaces;} </style>";
    }