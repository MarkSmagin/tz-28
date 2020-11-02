<?php
$id = $_COOKIE['user_id'];
$name = $_POST['user_name'];
$phone = $_POST['user_phone'];
$email = $_POST['user_email'];

define('USER_LIST', __DIR__ . "/$id.txt");
$file = fopen(USER_LIST, "a+");
$data = file_get_contents(USER_LIST);
if (file_exists(USER_LIST))
{
    $data .= "\r\n\r\nid:$id;\r\nИмя:$name;\r\nТелефон:$phone;\r\nTime:\"" . date('d.m.Y H:i') . "\"";
}
else
{
    $data .= "id:$id;\r\nИмя:$name;\r\nТелефон:$phone;\r\nTime:\"" . date('d.m.Y H:i') . "\"";
}
file_put_contents(USER_LIST, $data);



define('UPLOAD_DIR', __DIR__ . "/$id/");
if ($_FILES)
{
    foreach ($_FILES as $single_file){
        $f_type = $_FILES['user_file']['type'];
        if ($f_type == "image/gif" || $f_type == "image/png" || $f_type == "image/jpeg")
        {
            if (!file_exists("$id"))
            {  
                mkdir("$id");
                $file_name = UPLOAD_DIR . '/' . time() . '.' . end(explode(".", $single_file['name']));
                move_uploaded_file($single_file['tmp_name'], $file_name);
                createThumbnail($file_name, $id, $f_type);
            }
            $file_name = UPLOAD_DIR . '/' . time() . '.' . end(explode(".", $single_file['name']));
            move_uploaded_file($single_file['tmp_name'], $file_name);
            createThumbnail($file_name, $id, $f_type);
        }
    }
}

function createThumbnail($filename, $id, $type) {
    if($type == "image/jpeg") 
    {
        $im = imagecreatefromjpeg("/$id/" . $filename);
    } 
    else if ($type == "image/gif") 
    {
        $im = imagecreatefromgif("/$id/" . $filename);
    } 
    else if ($type == "image/png") 
    {
        $im = imagecreatefrompng("/$id/" . $filename);
    }
    
    $ox = imagesx($im);
    $oy = imagesy($im);
    
    $nx = 100;
    $ny = floor($oy * (100 / $ox));
    
    $nm = imagecreatetruecolor($nx, $ny);
    
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
    
    imagejpeg($nm, "/$id/" . $filename);
    $tn = '<img src="' . "/$id/" . $filename . '" alt="image" />';
    echo $tn;
}