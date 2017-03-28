<base href="../../"/>
<?php

    exec('./controllers/wkhtmltopdf/bin/wkhtmltopdf index.php form1.pdf');
    echo "PDF Created Successfully";

?>