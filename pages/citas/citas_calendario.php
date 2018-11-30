<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../assets/class/calendario.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



    <?php include_once("../assets/includes/menu.php") ?>

        <div id="page-wrapper">
            <input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Listado de Citas</h1>

                </div>
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="agregar_citas.php" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>
                </div>                
                <div class="col-lg-1 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="citas.php?opcion=1&vista=<?php echo $_GET["vista"]*-1;?>" title="Cambiar vista"><i class="fa fa-calendar fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="row">
    <div class="col-lg-10 pull-left">
        <div id="calendario" class="calendario" style="max-width: 50%">
        
        </div>
    </div>    
</div>
        </div>    
<script type="text/javascript">
    
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        var calendarEl;
        var calendar;
        //Iniciar el calendario de FULLCALENDAR
        inicializar_calendario();
        
    });
    
    function inicializar_calendario (){
            calendarEl = document.getElementById('calendario'); // grab element reference
            var url = '../assets/class/calendario_controlador.php?id_operacion=7';
            //alert (url);
            calendar = new FullCalendar.Calendar(calendarEl, {      
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaWeek',
                editable: true,
                navLinks: true, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: url,
                    method: 'GET',
                    failure: function() {
                      //document.getElementById('script-warning').style.display = 'block'
                      //alert("trtr");
                    },
                    success: function (){
                        //alert ("Cargado");
                    }
                },
                locale : "es",
                responsive: true,
                navLinks: true,
                selectable: true
            });        
            calendar.render();
            //$("#contenedor_calendario").hide(); 
      }
</script>