<?php
$ds          = DIRECTORY_SEPARATOR;

$storeFolder = 'uploads';

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $fileName = generateFilename();
    $targetFile =  $targetPath.$fileName;

    move_uploaded_file($tempFile,$targetFile);

    $uploadURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]uploads/$fileName";

    respond(array(
        'success' => true,
        'data' => array(
            'imageUrl' => $uploadURL
        ),
    ));
}

function generateFilename(){
    return base_convert(time(), 10, 36);
}

function respond($data){

    header('Content-type: application/json');
    echo json_encode($data);

}
