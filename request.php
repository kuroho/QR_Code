<?php

switch($_REQUEST['action']){
    case 'test':
        echo 'bonjour';
        break;
    default:
        echo 'marche pas';
        break;
}

?>