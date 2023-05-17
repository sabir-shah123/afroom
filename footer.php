  <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix text-center">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">All Rights Reserved & Copyright © By Afroon</span>
             
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.5/css/scroller.jqueryui.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.jqueryui.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.5/js/dataTables.scroller.min.js"></script>
    <script>
	$(document).ready(function() {
    $('#example').DataTable( {
        deferRender:    true,
        scrollY:        200,
        scrollCollapse: true,
        scroller:       true
    } );
} );
	</script>
    <!-- End custom js for this page -->
<style>
.ui-widget-header {
  border: 1px solid #fff;
  background: #fff;
  color: #333333;
  font-weight: bold;
}
.table-striped tbody tr:nth-of-type(2n+1) {
  background-color: #fff;
}
th{
text-align:center;
}
td{
border:1px solid #f2f2f2;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>  



      </body>
</html>