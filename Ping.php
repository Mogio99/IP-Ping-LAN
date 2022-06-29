<?php
    //Script that reading data from the HostList.csv file and constantly pings the IPs
    //for check their status on the Lan/Internet
    //Each line of the .csv file corresponds to a different Host/Device
    //ex file.csv line "ip address","Nome Host","Tag href for redirect on WebPage's device " 


    $iplist = array_map('str_getcsv', file('HostList.csv'));            //fill array
    $i = count($iplist);
    $result = [];

    for($j=0;$j<$i;$j++){                                               //loop for pinging every device in array
        $ip = $iplist[$j][0];
        $ping = exec("ping -n 1 $ip", $output,$status);                 //if status 0 = host online
        $result[] = $status;                                            //if status 1 = host offline
    }

    //<html>                                                            create table for shown result
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
        foreach($result as $temp => $k){                               //dynamic result in table                        
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

                                //refresh the page for pinging constantly
    echo header("refresh:0.5"); //number of second   
?>