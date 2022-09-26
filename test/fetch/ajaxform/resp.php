<?php

    if (isset($_GET['name'])){
        echo "Hello ".$_GET['name']." this is get method<br>
        You are ".$_GET['age']." years old";
    }

    if (isset($_POST['name'])){
        echo "Hello ".$_POST['name']." This is Post Method<br>
        You are ".$_POST['age']." years old";
    }

?>