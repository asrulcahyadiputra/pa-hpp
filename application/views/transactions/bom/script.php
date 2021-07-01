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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- JS Libraies -->
<script>
    $(document).ready(function() {
        // var BomTable = $('#table-bom-list')
        var contentList = $('#list-data')
        var formCreate = $('#form-create')
        var btnAdd = $('#btn-pluss')
        var btnBack = $('#btn-back')
        var gridBB = $('#tbl_posts')
        var btnSubmit = $('#btn-submit')
        var btnCancel = $('#btn-cancel')
        contentList.show()
        formCreate.hide()

        BomTable = $('#table-bom-list').DataTable({
            "paging": true,
            "info": true,
            "columnDefs": [{
                    "tragets": [1],
                    "searchable": true,
                    "orderable": true,
                },
                {
                    "tragets": [2, 3],
                    "searchable": true,
                    "orderable": false,
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0,
                    'className': 'text-center'
                },
                // {
                //     "searchable": false,
                //     "orderable": false,
                //     "targets": 4,
                //     "data": null,
                //     'defaultContent': action_html,
                // }
            ],
            "columns": [{
                    data: 'no'
                },
                {
                    data: 'kode_bom'
                },
                {
                    data: 'description'
                },
                {
                    data: 'product'
                },
            ]
        })

        btnAdd.on('click', function() {
            contentList.hide()
            formCreate.show()
            $('#tbl_posts >tbody >tr').remove()
        })

        btnBack.on('click', function() {
            contentList.show()
            formCreate.hide()
            $('#createBom').trigger('reset')
        })

        formCreate.on('submit', function(e) {
            e.preventDefault()
            var product_id = $('#product_id').val()
            var keterangan = $('#keterangan').val()
            var qty = $('qty').val()
            var BahanBakuRowCount = $('#tbl_posts >tbody >tr').length
            var form_data = $('form').serialize();
            if (BahanBakuRowCount > 0) {
                if (product_id == ' ' || keterangan == '') {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Form Tidak Boleh Kosong',
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('transaksi/bom/store') ?>',
                        data: form_data,
                        dataType: 'JSON',
                        success: function(data) {
                            console.log(data)
                            Swal.fire({
                                title: data.title,
                                icon: data.type,
                                text: data.message,
                                buttonsStyling: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3f37c9',
                            })
                            resetForm()
                            formCreate.hide()
                            contentList.show()
                            $('#tbl_posts >tbody >tr').remove()
                            loadData()
                        }
                    })
                }

            } else {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'Data Bahan Baku Tidak Valid',
                    buttonsStyling: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3f37c9',
                })
            }
        })

        function loadData() {
            BomTable.clear().draw()
            $.ajax({
                type: 'GET',
                url: '<?= base_url('transaksi/get_bom') ?>',
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data)
                    var rowData = data.values
                    BomTable.rows.add(rowData).draw(false)
                }

            })
        }

        loadData()

        function resetForm() {
            document.getElementById("createBom").reset();
        }
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
        // var didConfirm = confirm("Data Tidak dapat dikembalikan, Anda yakin ?");

        var id = jQuery(this).attr('data-id');
        var targetDiv = jQuery(this).attr('targetDiv');
        jQuery('#rec-' + id).remove();

        //regnerate index number on table
        $('#tbl_posts_body tr').each(function(index) {
            //alert(index);
            $(this).find('span.sn').html(index + 1);
        });
        return true;

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