<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/prism/prism.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/bootstrap-modal.js"></script>
<!-- JS Libraies -->
<?php
if ($this->uri->segment(1) == "Dashboard") { ?>
	<script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<?php } ?>
<?php if ($this->uri->segment(2) == "pelanggan" && $this->uri->segment(3) == "add") : ?>
	<script>
		$(document).ready(function() {
			$('#addCustomer').modal('show')
		});
	</script>
<?php endif ?>
<?php if ($this->uri->segment(2) == "produk" && $this->uri->segment(3) == "add") : ?>
	<script>
		$(document).ready(function() {
			$('#addProduct').modal('show')
		});
	</script>
<?php endif ?>
<?php if ($this->uri->segment(2) == "bahan_baku" && $this->uri->segment(3) == "add") : ?>
	<script>
		$(document).ready(function() {
			$('#addMaterial').modal('show')
		});
	</script>
<?php endif ?>
<?php if ($this->uri->segment(2) == "karyawan" && $this->uri->segment(3) == "add") : ?>
	<script>
		$(document).ready(function() {
			$('#addEmployee').modal('show')
		});
	</script>
<?php endif ?>
<?php if ($this->uri->segment(2) == "bom" && $this->uri->segment(3) == "create") : ?>
	<script>
		$(document).ready(function() {
			$('#material_id').change(function() {
				var material_id = $('#material_id').val();
				$.ajax({
					url: '<?= site_url() ?>transaksi/bom/find_material',
					method: 'POST',
					async: true,
					dataType: "JSON",
					data: {
						material_id: material_id
					},
					success: function(data) {
						$('#unit').html(data.material_unit);
					}
				});
				return false;
			});
		});
	</script>
<?php endif ?>
<?php if ($this->uri->segment(2) == "pesanan") : ?>
	<script>
		$(document).ready(function() {
			$('#product_id').change(function() {
				var product_id = $('#product_id').val();
				$.ajax({
					url: '<?= site_url() ?>transaksi/order/find_product',
					method: 'POST',
					async: true,
					dataType: "JSON",
					data: {
						product_id: product_id
					},
					success: function(data) {
						$('#order_qty').val(1);
						$('#order_price').val(data.sales_price);
					}
				});
				return false;
			});
		});
	</script>
<?php endif ?>
<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<!-- <script>
	$(document).ready(function() {
		$(".alert").fadeIn().delay(3000).fadeOut();
	});
</script> -->
<!-- currency formatting -->
<script>
	// Jquery Dependency
	$("input[data-type='currency']").on({
		keyup: function() {
			formatCurrency($(this));
		},
		blur: function() {
			formatCurrency($(this), "blur");
		}
	});


	function formatNumber(n) {
		// format number 1000000 to 1,234,567
		return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",", ".")
	}


	function formatCurrency(input, blur) {
		// appends $ to value, validates decimal side
		// and puts cursor back in right position.

		// get input value
		var input_val = input.val();

		// don't validate empty input
		if (input_val === "") {
			return;
		}

		// original length
		var original_len = input_val.length;

		// initial caret position 
		var caret_pos = input.prop("selectionStart");

		// check for decimal
		if (input_val.indexOf(".") >= 0) {

			// get position of first decimal
			// this prevents multiple decimals from
			// being entered
			var decimal_pos = input_val.indexOf(".");

			// split number by decimal point
			var left_side = input_val.substring(0, decimal_pos);
			var right_side = input_val.substring(decimal_pos);

			// add commas to left side of number
			left_side = formatNumber(left_side);

			// validate right side
			right_side = formatNumber(right_side);

			// On blur make sure 2 numbers after decimal
			if (blur === "blur") {
				right_side += "";
			}

			// Limit decimal to only 2 digits
			right_side = right_side.substring(0, 2);

			// join number by .
			input_val = "Rp " + left_side + "." + right_side;

		} else {
			// no decimal entered
			// add commas to number
			// remove all non-digits
			input_val = formatNumber(input_val);
			input_val = "Rp " + input_val;

			// final formatting
			if (blur === "blur") {
				input_val += "";
			}
		}

		// send updated string to input
		input.val(input_val);

		// put caret back in the right position
		var updated_len = input_val.length;
		caret_pos = updated_len - original_len + caret_pos;
		input[0].setSelectionRange(caret_pos, caret_pos);
	}
</script>


<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>

</body>

</html>
