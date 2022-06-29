<?php 
    
    
    $iplist = array_map('str_getcsv', file('HostList.csv'));
    $i = count($iplist);
    $result = [];

    for($j=0;$j<$i;$j++){
        $ip = $iplist[$j][0];
        $ping = exec("ping -n 1 $ip", $output,$status); //if status 0 = host online
        $result[] = $status;                            //if status 1 = host offline
    }

    echo '<html>
            <head>
                <title>Ping Checker</title>
            </head>
            <body bgcolor=FFFDD0>
                <font face = Bebas Neue>
                <table border=1>
                        <th colspan = 6> Ping Status </th>
                            <tr>
                                <!-- <td>ID </td> -->
                                <td align=center width=150><b>IP/URL</td>
                                <td align=center width=150><b>MAC Address</td>
                                <td align=center width=200><b>Nome Device</td>
                                <td align=center width=200><b>Funzione</td>
                                <td align=center width=200><b>Stato</td>               
                                <td align=center width=200><b>Redirect</td>
                            </tr>    
         ';                 
         header("refresh:1");
    foreach($result as $temp => $k){
    echo '                  <tr>';
    echo '                      <td align=center width=100>'.$iplist[$temp][0].'</td>';
    echo '                      <td align=center width=100>'.$iplist[$temp][1].'</td>';
    echo '                      <td align=center width=100>'.$iplist[$temp][2].'</td>';
    echo '                      <td align=center width=100>'.$iplist[$temp][3].'</td>';
                            if($result[$temp]==0)
    echo '                      <td align=center width=100><p style=color:green><b>Online</b></p></td>';
                            else
    echo '                      <td align=center width=100><p style=color:red><b>Offline</b></p></td>';                
    echo '                      <td align=center width=100>'.$iplist[$temp][4].'</td>';   
    echo '                  </tr>';
    }
    
    echo '      </table>
                </font>';  
    //header("refresh:1");//per refreshare la pagina ed aggiornare gli stati metere il numero di secondi 
    echo ' </body>      
          </html>';                     
?>