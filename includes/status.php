<?php
 if(isset($_GET['status'])){
    $status = $_GET['status'];
    if($status == 'success')
        flash_message(ucfirst(substr($_GET['page'],0,-1)).' saved successfully.', 'success');
    elseif($status == 'delete'){
        flash_message(ucfirst(substr($_GET['page'],0,-1)).' deleted successfully.', 'success');
    }elseif($status == 'error_delete'){
        flash_message('Error deleting '.ucfirst(substr($_GET['page'],0,-1)).'! please try again.', 'success');
    }elseif($status == 'error_create'){
        flash_message('Error creating '.ucfirst(substr($_GET['page'],0,-1)).'! please try again.', 'success');
    }elseif($status == 'duplicate'){
        flash_message('Duplicate username or email', 'danger');
    }
    else{
        flash_message('Something went wrong! please try again.', 'danger');
    }
}
echo flash_message();
?>