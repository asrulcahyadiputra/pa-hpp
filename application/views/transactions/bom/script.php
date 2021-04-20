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
        $('.btn-submit').click(function(e) {
            e.preventDefault()
            var transId = $('.btn-submit').attr('bom-id')
            var BahanBakuRowCount = $('#tbl_posts >tbody >tr').length;
            var BtklRowCount = $('#tbl_posts_btkl >tbody >tr').length;
            var BopRowCount = $('#tbl_posts_bop >tbody >tr').length;
            var html = ''
            console.log('Klik Submit Handler')
            console.log(transId)
            console.log(BahanBakuRowCount)
            console.log(BtklRowCount)
            console.log(BopRowCount)
            if (BahanBakuRowCount < 1 && BtklRowCount < 1 && BopRowCount < 1) {
                $('#alertModal').modal('show')
                html += `<p class="text-center">Bill of Material tidak valid, mohon cek kembali isian Anda</p>`
                $('.modal-body').html(html)
            } else if (BahanBakuRowCount < 1) {
                $('#alertModal').modal('show')
                html += `<p class="text-center">Tabel bahan baku (BB) tidak boleh kosong</p>`
                $('.modal-body').html(html)
            } else if (BtklRowCount < 1) {
                $('#alertModal').modal('show')
                html += `<p class="text-center">Tabel biaya tenaga kerja langsung (BTKL) tidak boleh kosong</p>`
                $('.modal-body').html(html)
            } else if (BopRowCount < 1) {
                $('#alertModal').modal('show')
                html += `<p class="text-center">Tabel biaya overhead pabrik (BOP) tidak boleh kosong</p>`
                $('.modal-body').html(html)
            } else {
                $('#createBom').submit()
            }
        });
    });
</script>
<!-- material script -->
<script type="text/javascript">
    jQuery(document).delegate('a.add-record', 'click', function(e) {
        console.log("add row")
        e.preventDefault();
        var content = jQuery('#sample_table tr'),
            size = jQuery('#tbl_posts >tbody >tr').length + 1,
            element = null,
            element = content.clone();

        element.attr('id', 'rec-' + size);
        element.find('.delete-record').attr('data-id', size);
        element.appendTo('#tbl_posts_body');
        element.find('.sn').html(size);
    });
</script>
<script>
    jQuery(document).delegate('a.delete-record', 'click', function(e) {
        e.preventDefault();
        var didConfirm = confirm("Data Tidak dapat dikembalikan, Anda yakin ?");
        if (didConfirm == true) {
            var id = jQuery(this).attr('data-id');
            var targetDiv = jQuery(this).attr('targetDiv');
            jQuery('#rec-' + id).remove();

            //regnerate index number on table
            $('#tbl_posts_body tr').each(function(index) {
                //alert(index);
                $(this).find('span.sn').html(index + 1);
            });
            return true;
        } else {
            return false;
        }
    });
</script>

<!-- direct labor script -->
<script type="text/javascript">
    jQuery(document).delegate('a.add-record-btkl', 'click', function(e) {
        console.log("add row")
        e.preventDefault();
        var content = jQuery('#sample_table_btkl tr'),
            size = jQuery('#tbl_posts_btkl >tbody >tr').length + 1,
            element = null,
            element = content.clone();

        element.attr('id', 'rec-btkl-' + size);
        element.find('.delete-record-btkl').attr('btkl-id', size);
        element.appendTo('#tbl_posts_body_btkl');
        element.find('.sn').html(size);
    });
</script>
<script>
    jQuery(document).delegate('a.delete-record-btkl', 'click', function(e) {
        e.preventDefault();
        var didConfirm = confirm("Data BTKL dikembalikan, Anda yakin ?");
        if (didConfirm == true) {
            var id = jQuery(this).attr('btkl-id');
            var targetDiv = jQuery(this).attr('targetDiv');
            jQuery('#rec-btkl-' + id).remove();

            //regnerate index number on table
            $('#tbl_posts_body_btkl tr').each(function(index) {
                //alert(index);
                $(this).find('span.sn').html(index + 1);
            });
            return true;
        } else {
            return false;
        }
    });
</script>

<!-- overhead script -->
<script type="text/javascript">
    jQuery(document).delegate('a.add-record-bop', 'click', function(e) {
        console.log("add row")
        e.preventDefault();
        var content = jQuery('#sample_table_bop tr'),
            size = jQuery('#tbl_posts_bop >tbody >tr').length + 1,
            element = null,
            element = content.clone();

        element.attr('id', 'rec-bop-' + size);
        element.find('.delete-record-bop').attr('bop-id', size);
        element.appendTo('#tbl_posts_body_bop');
        element.find('.sn').html(size);
    });
</script>
<script>
    jQuery(document).delegate('a.delete-record-bop', 'click', function(e) {
        e.preventDefault();
        var didConfirm = confirm("Data BOP dikembalikan, Anda yakin ?");
        if (didConfirm == true) {
            var id = jQuery(this).attr('bop-id');
            var targetDiv = jQuery(this).attr('targetDiv');
            jQuery('#rec-bop-' + id).remove();

            //regnerate index number on table
            $('#tbl_posts_body_bop tr').each(function(index) {
                //alert(index);
                $(this).find('span.sn').html(index + 1);
            });
            return true;
        } else {
            return false;
        }
    });
</script>



<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>


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