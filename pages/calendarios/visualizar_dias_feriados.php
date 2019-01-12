<?php
require_once '../assets/class/calendario.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<input type="hidden" id="hash" name="hash" value="<?php echo $hash ?>">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Días Feriados</h1>
                    <h6> Seleccione un día para modificarlo</h6>

                </div>
                <div class="col-lg-2 text-right pull-right">
                   <a class="btn btn-sm btn-success shared" href="calendarios.php?opcion=1" title="Agregar"><i class="fa fa-plus-circle fa-bg"></i></a>

                   <a class="btn btn-sm btn-success shared" href="calendarios.php?opcion=2&vista=<?php echo $_GET["vista"]*-1;?>" title="Cambiar vista"><i class="fa fa-calendar fa-bg"></i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

<div class="row">
    <div class="col-lg-10 pull-left">
        <div id="calendario" class="calendario">
        
        </div>
    </div>    
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() { // page is now ready...   
        var calendarEl = document.getElementById('calendario'); // grab element reference
        
        var calendar = new FullCalendar.Calendar(calendarEl, {            
                events: <?php
                    $eventos_json = calendario::devolver_eventos_json("url");        
                    echo calendario::devolver_eventos_json("url");
                    ?>,
                                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                locale: 'es-us',
                eventClick: function (info){
                    //alert ("ID:"+info.event.id);                    
                },navLinks: true,
                businessHours:{
                    daysOfWeek: [1,2,3,4,5,6],
                    startTime: '8:00',
                    endTime: '17:00'
                },        
                hiddenDays: [0],
                navLinkDayClick: function (date, jsEvent){
                    
                    var fecha_seleccionada      =   date.getFullYear()+"-"+(date.getMonth()+1)+"-"+(date.getDate()+1);                  
                    console.log(fecha_seleccionada);
                    //calendar.changeView('agendaDay', fecha_seleccionada);
                },
                        eventLimit: true,
                        editable: true,
                        eventMouseEnter: function(info){
                            //alert (info.event.id);
                            //$("#"+info.event.id).css('border-color', 'yellow');
                            
                            
                        }
            });        
        
        calendar.render();
    });
</script>
 