<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  $(function () {
    var $body = $('body');
    var mobileWidth = 767;

    $('.modal').each(function () {
      $(this).appendTo('body');
    });

    $(document).on('show.bs.modal', '.modal', function () {
      $(this).appendTo('body');
    });

    function closeMobileSidebar() {
      if ($(window).width() <= mobileWidth) {
        $body.removeClass('sidebar-open');
      }
    }

    $('[data-toggle="push-menu"]').on('click', function (event) {
      event.preventDefault();

      if ($(window).width() <= mobileWidth) {
        $body.toggleClass('sidebar-open');
        $body.removeClass('sidebar-collapse');
        return;
      }

      $body.toggleClass('sidebar-collapse');
      $body.removeClass('sidebar-open');
    });

    $('.content-wrapper, .main-header .navbar-custom-menu a').on('click', function () {
      closeMobileSidebar();
    });

    $(window).on('resize', function () {
      if ($(window).width() > mobileWidth) {
        $body.removeClass('sidebar-open');
      }
    });

    var currentPage = window.location.pathname.split('/').pop();
    if (currentPage) {
      $('.sidebar-menu a').each(function () {
        if ($(this).attr('href') === currentPage) {
          $(this).closest('li').addClass('active');
        }
      });
    }
  });
</script>
<!-- DataTables -->
<script>
  $(function () {

    $('#table1').DataTable({
	"lengthMenu" : [[20,50,100, -1], [20,50,100,'All']],
	'ordering'    : false,
	'autoWidth'   : false,
	"language": {
		"sProcessing": "กำลังดำเนินการ...",
		"sLengthMenu": "แสดง _MENU_ แถว",
		"sZeroRecords": "ไม่พบข้อมูล",
		"sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
		"sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
		"sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
		"sInfoPostFix": "",
		"sSearch": "ค้นหา ",
		"sUrl": "",
		"oPaginate": {
				"sFirst": "เิริ่มต้น",
				"sPrevious": "ก่อนหน้า",
				"sNext": "ถัดไป",
				"sLast": "สุดท้าย"
		}
	}
			 		
	})
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script src="assets/export_excel/xlsx.full.min.js"></script>
<script src="assets/export_excel/FileSaver.js"></script>
<script>
function ExcelReport()
{
    var sheet_name="excel_sheet";
    var elt = document.getElementById('table1');

    var wb = XLSX.utils.table_to_book(elt, {sheet: sheet_name});
    XLSX.writeFile(wb,'report.xlsx');
}
</script>









