<?php 
    
    function createDir($path) {
        $filepath = "uploads/2/" .$path;
        if(!is_dir($filepath)){
            mkdir($filepath, 0777);
            return true;
        }

        return false;
    }

    $path = 'post';
    if(createDir(($path))) {
        echo 'Folder created';
    } else {
        echo 'folder not created';
    }
?>