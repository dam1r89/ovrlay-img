<?php

$ds = DIRECTORY_SEPARATOR;

$storeFolder = 'uploads';

if (!empty($_FILES)) {

    checkForErrors();
    $tempFile = $_FILES['file']['tmp_name'];

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $fileName = generateFilename();
    $targetFile =  $targetPath.$fileName;

    move_uploaded_file($tempFile,$targetFile);
    $uploadURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]uploads/$fileName";

    respond(array(
        'imageUrl' => $uploadURL
    ));
}

function checkForErrors(){

    $errorCode = $_FILES['file']['error'];

    if ($errorCode !== 0){
        $errors = array(
            1=>"The uploaded file exceeds the max upload size",
            2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
            3=>"The uploaded file was only partially uploaded",
            4=>"No file was uploaded",
            6=>"Missing a temporary folder"
        );

        error($errors[$errorCode]);

    }
}

function generateFilename(){
    return base_convert(time(), 10, 36);
}

function respond($data){

    header('Content-type: application/json');
    echo json_encode(array(
        'success' => true,
        'data' => $data
    ));
    exit();
}

function error($msg){
    header('HTTP/1.1 406 Not Acceptable');
    header('Content-type: application/json');
    echo json_encode(array(
        'success' => false,
        'errorMessage' => $msg
    ));
    exit();
}
