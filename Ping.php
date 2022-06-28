<?php
    //require_once('HostList.php'); //for take the host list to ping
    //include_once('HostList.php');
    
    /*esempio array
    $iplist = array(
        array("10.64.0.15 ","Switch 1 "),
    );*/
    $iplist = array_map('str_getcsv', file('HostList.csv'));
    $i = count($iplist);
    $result = [];

    for($j=0;$j<$i;$j++){
        $ip = $iplist[$j][0];
        $ping = exec("ping -n 1 $ip", $output,$status); //if status 0 = host online
        $result[] = $status;                            //if status 1 = host offline
    }

    //<html>
    echo '<body bgcolor=FFFDD0>';
    echo '<font face = Bebas Neue>';
    echo ' <table border=1>
            <th colspan = 5> Ping Status </th>
            <tr>
                <!-- <td>ID </td> -->
                <td align=center width=150><b>IP/URL</td>
                <td align=center width=200><b>Stato</td>
                <td align=center width=200><b>Descrizione</td>
                <td align=center width=200><b>Redirect</td>
            </tr>    
         ';
        foreach($result as $temp => $k){
            echo '<tr>';
                
                //echo '<td>'.$temp.'</td>';
                echo '<td align=center width=100>'.$iplist[$temp][0].'</td>';
                if($result[$temp]==0)
                    echo '<td align=center width=100><p style=color:green><b>Host Online</b></p></td>';
                else
                    echo '<td align=center width=100><p style=color:red><b>Host Offline</b></p></td>';
                echo '<td align=center width=100>'.$iplist[$temp][1].'</td>';
                echo '<td align=center width=100>'.$iplist[$temp][2].'</td>';
            
            echo '</tr>';

        }

    echo "</table>";
    echo '</font';        
    echo'</body>';      
    //</html>

                                //per refreshare la pagina ed aggiornare gli stati
    echo header("refresh:0.5");   //metere il numero di secondi
                                
?>