//save-image.php

<?php

    $data = file_get_contents($_REQUEST['imgData']);

    file_put_contents('image.jpg', $data);

?>
                