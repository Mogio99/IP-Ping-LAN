<?php   
    $iplist = array_map('str_getcsv', file('pippo.csv'));
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
                <link rel="stylesheet" href="style.css">
                
            </head>
            <body>
                <p class="timer">Tempo al prossimo Refresh/Ping:<p>
                <div class="timer" id="timer"></div><br><br>

                <div id="DivInput">
                    <select class="drop" id="dropdown" oninput="filterTable()" margin: auto;>
                        <option>Tutti</option>
                        <option>Building Automation</option>
                        <option>Computer</option>
                        <option>Firewall</option>
                        <option>Hypervisor</option>
                        <option>Industrial Control System</option>
                        <option>Information Technology</option>
                        <option>IP Camera</option>
                        <option>Network Access Control</option>
                        <option>Networking</option>
                        <option>Physical Security</option>
                        <option>Process Instrumentation and Metrology</option>
                        <option>Programmable Logic Controller</option>
                        <option>Router or Switch</option>
                        <option>Server</option>
                        <option>Storage</option>
                        <option>Surveillance</option>
                        <option>Switch</option>
                        <option>Uninterruptible Power Supply</option>
                        <option>Unknown</option>
                        <option>Wireless Bridge</option>
                        <option>Workstation</option>
                    </select>
                  </div>
                  <div class="conteiner">
                    <div class="BCenter">
                      <p><button class="OFF" onclick="sortTableStatusOffF()">Ordina per Offline</button></p>
                      <p><button class="ON" onclick="sortTableStatusOnF()">Ordina per Online</button></p>
                      <!--<p><button onclick="sortTableStatusIPDec()">Ordina per IP Decrescente</button></p>
                      <p><button onclick="sortTableStatusIPCresc()">Ordina per IP Crescente</button></p>-->
                    </div>
                  </div>

                <br>
                <br>

                <div id="DivTable">
                    <table id="table">
                            <th colspan=6> Ping Status </th>
                                <tr>
                                    <td><b>Host</td>
                                    <td><b>Indirizzo IP</td>
                                    <td><b>Nome Device</td>
                                    <td><b>Funzione Device</td>
                                    <td><b>Stato</td>               
                                    <td><b>Redirect</td>
                                </tr>    
         ';               
    //header("refresh:30");
    foreach($result as $temp => $k){
    echo '                      <tr>';
    echo '                          <td>'.$iplist[$temp][0].'</td>';
    echo '                          <td>'.$iplist[$temp][1].'</td>';
    echo '                          <td>'.$iplist[$temp][2].'</td>';
    echo '                          <td>'.$iplist[$temp][3].'</td>';
                                if($result[$temp]==0)
    echo '                          <td><p class="online">Online</p></td>';
                                else
    echo '                          <td><p class="offline">Offline</p></td>';                
    echo '                          <td>'.$iplist[$temp][4].'</td>';   
    echo '                      </tr>';
    }
    
    echo '          </table>
                </div>

                <script>

                    function sortTableStatusOffF() {
                        var table, rows, switching, i, x, y, shouldSwitch;
                        table = document.getElementById("table");
                        switching = true;
                        
                        while (switching) {
                          switching = false;
                          rows = table.rows;
                          
                          for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[4];
                            y = rows[i + 1].getElementsByTagName("TD")[4];
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                              shouldSwitch = true;
                              break;
                            }
                          }
                          if (shouldSwitch) {

                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                          }
                        }
                      }

                      function sortTableStatusOnF() {
                        var table, rows, switching, i, x, y, shouldSwitch;
                        table = document.getElementById("table");
                        switching = true;
                        
                        while (switching) {
                          switching = false;
                          rows = table.rows;
                          
                          for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[4];
                            y = rows[i + 1].getElementsByTagName("TD")[4];
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                              shouldSwitch = true;
                              break;
                            }
                          }
                          if (shouldSwitch) {

                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                          }
                        }
                      }

                      function sortTableStatusIPCresc() {
                        var table, rows, switching, i, x, y, shouldSwitch;
                        table = document.getElementById("table");
                        switching = true;
                        
                        while (switching) {
                          switching = false;
                          rows = table.rows;
                          
                          for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[1];
                            y = rows[i + 1].getElementsByTagName("TD")[1];
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                              shouldSwitch = true;
                              break;
                            }
                          }
                          if (shouldSwitch) {

                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                          }
                        }
                      }

                      function sortTableStatusIPDec() {
                        var table, rows, switching, i, x, y, shouldSwitch;
                        table = document.getElementById("table");
                        switching = true;
                        
                        while (switching) {
                          switching = false;
                          rows = table.rows;
                          
                          for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[1];
                            y = rows[i + 1].getElementsByTagName("TD")[1];
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                              shouldSwitch = true;
                              break;
                            }
                          }
                          if (shouldSwitch) {

                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                          }
                        }
                      }
                    
                    function filterTable() {
                        let dropdown, table, rows, cells, name, filter;

                        dropdown = document.getElementById("dropdown");
                        table = document.getElementById("table");
                        rows = table.getElementsByTagName("tr");
                        filter = dropdown.value;

                        for (let row of rows) { 
                          cells = row.getElementsByTagName("td");
                          name = cells[3] || null; 
                          if (filter === "Tutti" || !name || (filter === name.textContent)) {
                            row.style.display = ""; 
                          }
                          else {
                            row.style.display = "none"; 
                          }
                        }
                      }

                    var timeLeft = 29;
                    var elem = document.getElementById("timer");
                    var timerId = setInterval(countdown, 1000);

                    function countdown() {
                    if (timeLeft == -1) {
                        clearTimeout(timerId);
                    }else{
                        elem.innerHTML = timeLeft;
                        timeLeft--;
                    }
                    }

                </script> 
            </body>      
          </html>';                     
?>