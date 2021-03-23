<?php
    include 'connect.php';
    $c = $_GET['c'];
    if ($c =='query'){
        echo json_encode(DB::query($_POST['sql']));
    } else if ($c == 'work'){
        DB::work($_POST['sql']);
    } else if ($c == 'copy'){
        $form = DB::query("SELECT * from form WHERE invite = '$_GET[invite]'", 1)[0];
        $form->invite = $_GET['new_invite'];
        DB::insert('form', $form);
        $que = DB::query("SELECT * from question WHERE invite = '$_GET[invite]'", 1);
        foreach ($que as $key => $val) {
            $val->invite = $_GET['new_invite'];
            $id = $val->id;
            unset($val->id);
            DB::insert('question', $val);
            if ($_GET['type'] == 1) {
                $ques_id = DB::query("SELECT MAX(`id`) as max FROM `question`")[0]->max;
                $res = DB::query("SELECT * from response WHERE question_id = $id", 1);
                foreach ($res as $key => $value) {
                    $value->question_id = $ques_id;
                    $value->invite = $_GET['new_invite'];
                    unset($value->id);
                    DB::insert('response', $value);
                }
            }
        }
    } else if ($c == 'csv_out'){
        header('Content-type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        $invite = $_GET['invite'];
        // form
        $data = [['form']];
        $form = (array)DB::query("SELECT * FROM `form` WHERE invite = '$invite'", 1)[0];
        array_push($data, array_keys($form));
        array_push($data, array_values($form));
        // question
        array_push($data, ['question']);
        $question = DB::query("SELECT * FROM `question` WHERE invite = '$invite'", 1);
        array_push($data, array_keys((array)$question[0]));
        foreach ($question as $key => $val)
            array_push($data, array_values((array)$val));
        // response
        array_push($data, ['response']);
        $response = DB::query("SELECT * FROM `response` WHERE invite = '$invite'", 1);
        array_push($data, array_keys((array)$response[0]));
        foreach ($response as $key => $val)
            array_push($data, array_values((array)$val));
        // array to line
        $csv = fopen('php://output', 'w');
        fputs($csv, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // Excel 打開中文
        foreach( $data as $line )
            fputcsv( $csv, $line );
        fclose($csv);
    } else if ($c == 'csv_in'){
        $file = $_FILES['csv'];
        $csv = fopen($file['tmp_name'], 'r');
        $id_fix = (object)[];
        function in($form, $key ,$val){
            $keys = "`".join(array_values($key),'`,`')."`";
            $vals = "'".join(array_values($val),"','")."'";
            pri("INSERT INTO `$form` ($keys) VALUES ($vals)");
            DB::work("INSERT INTO `$form` ($keys) VALUES ($vals)");
        }
        function read($form) {
            $form = $form[0];
            $title = fgetcsv($GLOBALS['csv']);
            if ($form == 'question' || $form == 'response')
                unset($title[0]);
            while ($data = fgetcsv($GLOBALS['csv'])){
                if (count($data) == 1) { // New form
                    read($data);
                    break;
                }
                if ($form == 'form') {
                    $fz = DB::query("SELECT count(*) as total FROM form WHERE invite LIKE '$data[0]'")[0]->total;
                    pri($fz);
                    if ($fz) {
                        $_SESSION['message'] = '邀請碼重複';
                        href('manage.php');
                    }
                    in($form, $title, $data);
                } else if ($form == 'question') {
                    $temp_id = $data[0];
                    unset($data[0]);
                    in($form, $title, $data);
                    $GLOBALS['id_fix']->{$temp_id} = DB::query("SELECT MAX(`id`) as id FROM `question`")[0]->id;
                } else if ($form == 'response') {
                    unset($data[0]);
                    $data[2] = $GLOBALS['id_fix']->{$data[2]};
                    in($form, $title, $data);
                }
            }
        } read(remove_utf8_bom(fgetcsv($csv))); 
        fclose($csv);
        $_SESSION['message'] = '新增成功';
        href('manage.php');
    }
?>