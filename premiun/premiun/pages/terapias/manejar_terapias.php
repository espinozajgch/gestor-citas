<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="container-fluid">                
                <!-- /.row -->

                <div class="row ">
                    <br>
                    <div class="col-md-12 mx-4">
                        <?php
                    if (isset($_GET["opcion"])){
                        if ($_GET["opcion"]==1){
                            include_once("terapias/asignar_terapia.php");
                        }
                        else if ($_GET["opcion"]==2){                            
                            include_once("terapias/configurar_terapias.php");
                        }
                    }                    
                    
                    ?>
                    </div>
            </div>
            <!-- /.container-fluid -->
        </div>