<?php
function get_picture($pathtodir)
{
    if(file_exists($pathtodir))
    {

        $pictures=array();
        $d = opendir($pathtodir);
        while(false!==($file=readdir($d))) {
            if($file=='.' || $file=='..'){
                continue;
            }
            $pictures[] = $pathtodir . "/" . $file;
        }
        return $pictures;
    }
    else{

        return false;
    }
}
?>