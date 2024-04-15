<?php
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename=test.xls");
        echo '<table>'.chr(13);
        echo '    <tr>'.chr(13);
        echo '        <td>Cellule 1:1</td>'.chr(13);
        echo '        <td>Cellule 1:2</td>'.chr(13);
        echo '    </tr>'.chr(13);
        echo '    <tr>'.chr(13);
        echo '        <td>Cellule 2:1</td>'.chr(13);
        echo '        <td>Cellule 2:2</td>'.chr(13);
        echo '    </tr>'.chr(13);
        echo '</table>'.chr(13);
?>