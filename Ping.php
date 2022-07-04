<?php   
    //array load
    $iplist = array_map('str_getcsv', file('HostList.csv')); //change with your .csv file with eventualy is path
    $i = count($iplist);
    $result = [];

    //loop for ping host
    for($j=0;$j<$i;$j++){
        $ip = $iplist[$j][0];
        $ping = exec("ping -n 1 $ip", $output,$status); //if status 0 = ping done
        $result[] = $status;                            //if status 1 = ping failur
    }
    //html showing table, button and combox
    echo '<html>
            <head>
                <title>Ping Checker</title>
                <link rel="stylesheet" href="style.css">
                
            </head>
            <body>
                <p class="timer">Tempo al prossimo Refresh/Ping:<p>
                <div class="timer" id="timer"></div><br><br>

                <div id="DivInput">
                    <select class="drop" id="dropdown" oninput="filterTable()" autocomplete="off">
                        <option>Tutti</option>
                        <option>Switch</option>
                        <option>Network Access Control</option>
                        <option>Computer</option>
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
    header("refresh:3"); //time for new ping (in second)
    foreach($result as $temp => $k){
    echo '                      <tr>';
    echo '                          <td>'.$iplist[$temp][0].'</td>';          //dynamic population of table, by taking array position
    echo '                          <td>'.$iplist[$temp][1].'</td>';
    echo '                          <td>'.$iplist[$temp][2].'</td>';
    echo '                          <td>'.$iplist[$temp][3].'</td>';
                                if($result[$temp]==0)                         //ping result, if 0 then is pinging properly, else is not pinging
    echo '                          <td><p class="online">Online</p></td>';
                                else
    echo '                          <td><p class="offline">Offline</p></td>';                
    echo '                          <td>'.$iplist[$temp][4].'</td>';   
    echo '                      </tr>';
    }
    
    echo '          </table>
                </div>

                <script>
                    //function for shown offline device first with button
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
                      //function for shown online device first with button
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
                      //function for sort table by IP with button
                      //Uncomment the botton for use
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

                      //function for sort table by IP decr with button
                      //Uncomment the botton for use
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

                      //function for filter table by combobox choose
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
                    
                      //function for timer
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