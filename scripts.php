    <!-- jquery, popper and bootstrap js 
    <script src="template/js/jquery-3.3.1.min.js"></script>-->
	<script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- cookie js -->
    <script src="template/vendor/cookie/jquery.cookie.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- template custom js -->
    <script src="template/js/main.js"></script>

	<script src="template/js/perso.js"></script>
	
    <!-- Plugin JavaScript -->
    <script src="template/vendor/moment/moment.js"></script>
    <script src="template/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="template/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="template/vendor/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="template/vendor/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="template/vendor/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="template/vendor/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="template/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="template/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
	<script>
	jQuery('#txtdata').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
	</script>
	
    <!-- Sweet-Alert  -->
    <script src="template/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="template/vendor/sweetalert/jquery.sweet-alert.custom.js"></script>
	
	
    <script type="text/javascript" src="template/vendor/html5-editor/bootstrap-wysihtml5.js"></script>
	<script src="template/vendor/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="template/vendor/html5-editor/bootstrap-wysihtml5.js"></script>
	<script>
    $(function() {

        $('.textarea_editor').wysihtml5();


    });
    </script>
	
	<!-- Propeller textfield js -->
	<script type="text/javascript" src="template/vendor/propeller-master/components/textfield/js/textfield.js"></script>

	<script type="text/javascript" src="template/vendor/propeller-master/components/select2/js/pmd-select2.js"></script>
	<script type="text/javascript" src="template/vendor/propeller-master/dist/js/propeller.min.js"></script>
	
	
	<!-- Propeller alerts js -->
	<script type="text/javascript" src="template/vendor/propeller-master/components/alert/js/alert.js"></script>

    <!-- Propeller tabs js -->
    <script type="text/javascript" language="javascript" src="template/vendor/propeller-master/components/tab/js/tab-scrollable.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
	
	<!-- MASK INPUT -->
    <script src="template/vendor/mask.money/jquery.maskMoney.js"></script>
    <script>
	    //$(".alert").alert('close');
        $("#dinheiro").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctdebito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctcredito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ted").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#desc").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
		$("#totals").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    </script>
	
	<!-- autocomplete js--> 
    <script src="template/vendor/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.min.js"></script> 

    <!-- page specific script -->
    <script src="template/js/autocomplete.js"></script>

	    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            var swiper = new Swiper('.introduction', {
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        });
		
		$('#pwainstall_button').on('click',function()
        {
		    navigator.serviceWorker.register('/service-worker.js')
        .then((reg) => {
          console.log('Service worker registered.', reg);
        });
		});

    </script>
    <script src="/scripts/luxon-1.11.4.js"></script>
  <script src="/scripts/app.js"></script>
  <!-- CODELAB: Add the install script here -->
  <script src="/scripts/install.js"></script>

  <script>
    // CODELAB: Register service worker.
	if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js')
        .then((reg) => {
          console.log('Service worker registered.', reg);
        });
  });
}
  </script>