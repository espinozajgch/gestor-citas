<div class="row ">
    <br>
    <table width="100%" class="table table-striped table-bordered table-hover" id="tabla_terapias">
            <thead>
                <tr>
                   
                    <th>Nombre</th>
                    <th>Terapias</th>
                    <!--th>Precio</th-->   
                    <th>Estado</th>
                    <th>Acciones</th>                        
                </tr>
            </thead>                                            
            <tbody >
                <?php
                    $datos = Pacientes::obtener_lista_terapias_pacientes($bd, $id_paciente);
                    //$datos = "";
                    $lista = "";

                    foreach ($datos as $particulares) {

                        $lista .= ' <tr">
                                    <td>'. strtoupper($particulares["dpt"]) .'</td>
                                    <td>'. strtoupper($particulares["cant"]) .'</td>
                                    <!--td>'. strtoupper($particulares["cant"]) .'</td-->
                                    <td>'. strtoupper($particulares["estado"]) .'</td>
                                    <td class="center text-center pull-center" style="width: 30%">
                                        
                                    </td>
                                </tr>';

                    }
                    echo $lista;/**/
                ?>
            </tbody>
           </table>
</div>
