<?php
    if(!empty($_SESSION['messages'])){
    $myMessages = $_SESSION['messages'];
    foreach($myMessages as $key=>$message){
        echo '<div class="alert alert-'.$key.' alert-dismissible fade show mt-2" role="alert">'.$message.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
    }
    $_SESSION['messages']=[];
    }
