<?php
$upload_dir = "database/sell/".$path."/";
$_COOKIE["Error_download"] = false;
foreach($_FILES["myphoto"]["error"] as $key=>$error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmpname = $_FILES["myphoto"]["tmp_name"][$key];
        $mu = pathinfo($_FILES["myphoto"]["name"][$key]);
        if (!move_uploaded_file($tmpname,$upload_dir.time().".".$mu["extension"]))
            $_COOKIE["Error_download"] = true;

    }
sleep(1);
}
?>
