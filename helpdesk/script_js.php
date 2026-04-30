<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

	<script src='<?php echo $fullcalendar_path?>/core/main.js'></script>
    <script src='<?php echo $fullcalendar_path?>/daygrid/main.js'></script>
    <script src='<?php echo $fullcalendar_path?>/core/locales/th.js'></script>
    <script src='<?php echo $fullcalendar_path?>/timegrid/main.js'></script>
    <script src='<?php echo $fullcalendar_path?>/interaction/main.js'></script>
    <script src='<?php echo $fullcalendar_path?>/list/main.js'></script>

	<script type="text/javascript">
      $(function(){
          // กำหนด element ที่จะแสดงปฏิทิน
        var calendarEl = $("#calendar")[0];
 
          // กำหนดการตั้งค่า
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction','dayGrid', 'timeGrid', 'list' ], // plugin ที่เราจะใช้งาน
            defaultView: 'dayGridMonth', // ค้าเริ่มร้นเมื่อโหลดแสดงปฏิทิน
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
			
			defaultDate: '<?php echo date('Y-m-d');?>',
			timezone: 'UTC+7',
			
			events: 'load_event.php',
    		selectable:true,
   			selectHelper:true,
	  
            eventLimit: true, 
			displayEventTime: false,	// ปิดแสดงเวลา
            locale: 'th',    // กำหนดให้แสดงภาษาไทย
            firstDay: 0, // กำหนดวันแรกในปฏิทินเป็นวันอาทิตย์ 0 เป็นวันจันทร์ 1
            showNonCurrentDates: false, // แสดงที่ของเดือนอื่นหรือไม่
            eventTimeFormat: { // รูปแบบการแสดงของเวลา เช่น '14:30' 
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            }
        });
          
         // แสดงปฏิทิน 
        calendar.render();            
      });
      </script> 