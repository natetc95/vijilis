<?php
if(!mkdir('ayy', 0777, true)) {
    print_r(error_get_last());
}
?>