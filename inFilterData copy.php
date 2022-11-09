  <table id="example2" class="table table-bordered table-striped">

      <thead>
          <tr>
              <th>id</th>
              <th>data prenotazione</th>
              <th>data appuntamento</th>
              <th>fascia_oraria</th>
              <th>tipo attivita</th>
              <th>stato prenotazione</th>
              <th>check in</th>
              <th>Utente</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $al = $_POST["dataAl"];
            $dal = $_POST["dataDal"];
            $listaggData = [];
            $listgraph = [];
            include 'config.php';
            $risultato = $con->query("SELECT p.id_prenotazione, DATE_FORMAT(p.data_effettuazione,\"%d-%m-%Y\") , DATE_FORMAT(p.data_appuntamento,\"%d-%m-%Y\"), p.fascia_oraria, a.nome_attivita  , p.stato_prenotazione,p.presenza, p.id_utente_prenotazione,  u.nome , u.cognome , p.str_data FROM prenotazioni as p join utenti as u on u.id_utente = p.id_utente_prenotazione join login as l on l.login_id = u.login_id  join attivita as a on p.tipo_attivita = a.id_attivita WHERE  l.stato=1 And p.data_appuntamento>=$dal And p.data_appuntamento<=$al order by p.data_appuntamento desc ");

            while ($row = mysqli_fetch_array($risultato, MYSQLI_NUM)) {
                $listaggData = [$row[2], $row[3]];

                echo "<tr>";

                echo "<td> $row[0]</td>";
                echo "<td> $row[1]</td>";
                echo "<td> $row[2]</td>";
                echo "<td> $row[3]</td>";
                echo "<td> $row[4]</td>";

                echo "<td> $row[5]</td>";
                echo "<td> $row[6]</td>";


                echo "<td> $row[8] $row[9]</td>";
                echo "<td class=\"project-actions text-right\">
                                                <ul class=\"list-inline\">
                                                <li style=\"margin-bottom:5px;\">
                                                            <a class=\"btn btn-info btn-sm\" href=\"./schedautente.php?id=$row[7]\">
                                                             <i class=\"fas fa-folder\"> </i> Scheda Cliente</a>
                                                            </li>                                                          
                                                            <li>                                                          
                                                         <a class=\"btn btn-info btn-sm\" href=\"./prenotazioni.php?day=$row[10]\"><i class=\"fas fa-pencil-alt\"> </i> Scheda Prenotzaioni</a>
                                                </li>
                                                </ul>
                        </td>";
                echo " </tr>";
                array_push($listgraph, $listaggData);
                $listaggData = [];
            }
            $con->close();
           // include 'grafico.php';
            ?>
      </tbody>
     
      <script>
          $(function() {
              $("#example2").DataTable({

                  "zeroRecords": "No records to display",
                  "responsive": true,
                  "lengthChange": true,
                  "autoWidth": true,

              }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

          });
      </script>