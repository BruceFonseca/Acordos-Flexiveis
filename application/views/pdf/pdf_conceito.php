<?php

echo '<div class="retrieve-table">';
echo '<h2>'. $status->dsc_assunto  .'</h2>';  

    echo 
    '
        <div class="" ctr="assunto/imprimir/'. $status->id_assunto .'">
          <!-- Default panel contents -->
          <div class="">
            <p>'.
                (urldecode($status->dsc_conceito))
            .'</p>
          </div>
        </div>
    ';


?>

</div>