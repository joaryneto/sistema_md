    <!-- jquery, popper and bootstrap js -->
    <!--<script src="template/js/jquery-3.3.1.min.js"></script>-->
	<script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="template/js/AjaxScript.js.php"></script>
    <noscript>Por favor habilite JavaScript para usar este site.</noscript>
    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- cookie js -->
    <script src="template/vendor/cookie/jquery.cookie.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            $(".sparklinechart").sparkline([5, 6, -7, 2, 0, -4, -2, 4], {
                type: 'bar',
                zeroAxis: false,
                barColor: '#00bf00',
                height: '30',
            });
            $(".sparklinechart2").sparkline([-5, -6, 4, -2, 0, 4, 2, -4], {
                type: 'bar',
                zeroAxis: false,
                barColor: '#00bf00',
                height: '30',
            });

            /* Swiper slider */
            var swiper = new Swiper('.swiper-prices', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });
            var swiper = new Swiper('.swiper-categories', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                pagination: false,
            });
            var swiper = new Swiper('.swiper-shares', {
                slidesPerView: 5,
                spaceBetween: 0,
                pagination: false,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                }
            });
        })

    </script>

    <!-- template custom js -->
    <script src="template/layout/spa/js/main.js"></script>

	<script type="text/javascript" src="template/js/person.js.php"></script>
	
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
	jQuery('#txtdata23').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
	</script>
	
    <!-- Sweet-Alert  -->
    <script src="template/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="template/vendor/sweetalert/jquery.sweet-alert.custom.js"></script>
	
	<!-- Ionic for this template 
    <script type="module">
    import { modalController } from 'https://cdn.jsdelivr.net/npm/@ionic/core/dist/ionic/index.esm.js';
    window.modalController = modalController;
    </script>-->
  
    <script type="text/javascript" src="template/vendor/html5-editor/bootstrap-wysihtml5.js"></script>
	<script src="template/vendor/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="template/vendor/html5-editor/bootstrap-wysihtml5.js"></script>
	<!-- Propeller textfield js -->
	<script type="text/javascript" src="template/vendor/propeller-master/components/textfield/js/textfield.js"></script>

    <script type="text/javascript" src="template/vendor/propeller-master/components/dropdown/js/dropdown.js"></script>
	<script type="text/javascript" src="template/vendor/propeller-master/components/select2/js/pmd-select2.js"></script>
	<script type="text/javascript" src="template/vendor/propeller-master/dist/js/propeller.min.js"></script>
	<script type="text/javascript" src="template/vendor/propeller-master/components/checkbox/js/checkbox.js"></script>
	
	<!-- Propeller alerts js -->
	<script type="text/javascript" src="template/vendor/propeller-master/components/alert/js/alert.js"></script>

    <!-- Propeller tabs js -->
    <script type="text/javascript" language="javascript" src="template/vendor/propeller-master/components/tab/js/tab-scrollable.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
	
	
	<!-- MASK INPUT -->
    <script src="template/vendor/mask.money/jquery.maskMoney.js"></script>
    <script>
	$(window).on('load', function () {
	    //$(".alert").alert('close');
        $("#dinheiro").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctdebito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctcredito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ted").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#desc").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
		$("#totals").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	});
    </script>
	
    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            var swiper = new Swiper('.introduction', {
                pagination: {
                    el: '.swiper-pagination',
                },
            });
        });
		
		var deferredPrompt;

window.addEventListener('beforeinstallprompt', function(e) {
  console.log('beforeinstallprompt Event fired');
  e.preventDefault();

  // Stash the event so it can be triggered later.
  deferredPrompt = e;

  return false;
});

const btnSave = document.getElementById('btninstall');

btnSave.addEventListener('click', function() {
  if(deferredPrompt !== undefined) {
    // The user has had a postive interaction with our app and Chrome
    // has tried to prompt previously, so let's show the prompt.
    deferredPrompt.prompt();

    // Follow what the user has done with the prompt.
    deferredPrompt.userChoice.then(function(choiceResult) {

      console.log(choiceResult.outcome);

      if(choiceResult.outcome == 'dismissed') {
        console.log('User cancelled home screen install');
      }
      else {
        console.log('User added to home screen');
      }

      // We no longer need the prompt.  Clear it up.
      deferredPrompt = null;
    });
  }
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