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
<script src="<?php echo base_url(); ?>assets/js/downupPopup.js"></script>
<!-- JS Libraies -->
<script>
    $(document).ready(function() {
        function format_number(x) {
            return new Intl.NumberFormat('de-DE').format(x)
        }
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
        var action_html = '<a href="#" id="btn-delete" class="text-danger"><i class="fa fa-trash"></i></a>'
        var BomTable = $('#table-bom-list').DataTable({
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
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 5,
                    "data": null,
                    'defaultContent': action_html,
                }
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
                {
                    data: 'lock_doc'
                }
            ]
        })

        btnAdd.on('click', function() {
            $('#trans_id').val('AUTO')
            contentList.hide()
            formCreate.show()
            var html = ''
            html += `<h5><i>Create Bill of Materials (BOM)</i></h5>`
            $('#header-form').html(html)
            $('#tbl_posts >tbody >tr').remove()
        })

        $('#table-bom-list').on('click', '#btn-edit', function(e) {
            e.preventDefault()
            var id = $(this).closest('tr').find('td').eq(1).html();
            editData(id)
        })

        // click td
        $('#table-bom-list').on('click', 'td', function(e) {
            e.preventDefault()
            if ($(this).index() != 5) {
                var id = $(this).closest('tr').find('td').eq(1).html();
                preview_data(id)
            }

        })
        // button delete
        $('#table-bom-list').on('click', '#btn-delete', function(e) {
            e.preventDefault()
            var id = $(this).closest('tr').find('td').eq(1).html();
            destroy(id);
        });

        btnBack.on('click', function() {
            contentList.show()
            formCreate.hide()
            $('#createBom').trigger('reset')
        })

        btnCancel.on('click', function() {
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
                    console.log(data)
                    var rowData = data.values
                    BomTable.rows.add(rowData).draw(false)
                }

            })
        }

        function editData(id) {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('transaksi/bom/edit/') ?>' + id,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    if (data.status) {
                        var html = ''
                        var htmlDetail = ''
                        html += `<h5><i>Edit Bill of Materials (BOM)</i></h5>`
                        $('#header-form').html(html)
                        // set  form value
                        $('#trans_id').val(data.trans_id)
                        $('#product_id').val(data.product_id)
                        $('textarea#keterangan').val(data.description)
                        var detail = data.details
                        var no = 1;
                        var dataId = 1;
                        var id = 1;
                        $(".material_id option[value='MTR-0001']").prop("selected", true);
                        $(".material_id option[value='MTR-0001']").prop("selected", true);
                        for (let i = 0; i < detail.length; i++) {

                            $('.qty').val(detail[i].qty)
                            htmlDetail += `<tr id ="rec-` + id++ + `">
                                <td class="text-center">
                                    <span class="sn">` + no++ + `</span>
                                </td>
                                <td>
                                    <select name="material_id[]" class="form-control material_id"  required>
                                        <option value="">-pilih bahan baku-</option>
                                        <?php foreach ($materials as $rowData) : ?>
                                            <option value="<?= $rowData['material_id'] ?>"><?= $rowData['material_id'] . ' ' . $rowData['material_name'] . ' [Satuan:' . $rowData['material_unit'] . ']' ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="qty[]" class="form-control qty" value="1" required>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <a href="#" class="text-danger  btn-icon delete-record" data-id="` + dataId++ + `">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                </td>

                            </tr>`
                        }
                        $('#tbl_posts_body').html(htmlDetail)
                        // var content = jQuery('#sample_table tr'),
                        //     size = jQuery('#tbl_posts >tbody >tr').length + 1,
                        //     element = null,
                        //     element = content.clone();

                        // element.attr('id', 'rec-' + size);
                        // element.find('.delete-record').attr('data-id', size);
                        // element.appendTo('#tbl_posts_body');
                        // element.find('.sn').html(size);

                        contentList.hide()
                        formCreate.show()
                    } else {
                        Swal.fire({
                            title: data.title,
                            icon: data.type,
                            text: data.message,
                            buttonsStyling: true,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3f37c9',
                        })

                    }

                }
            })
        }

        loadData()
        // bottom sheet
        $("#previewData").downupPopup({
            distance: 20,
            width: "80%",
            headerText: "Detail Data Bill of Material",
        });

        function preview_data(id) {
            console.log('preview data ' + id)
            $.ajax({
                type: 'GET',
                url: '<?= base_url('transaksi/bom/find/') ?>' + id,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    $('#previewData').downupPopup('open');
                    var html = ''

                    html += `<div class='row' style='margin:10px;border-top: double;'>
                        <div class='col-md-12 overflow-auto'>
                            <table class='table table-sm mt-3'>
                                <tr>
                                    <td style='width:20%'>Kode Bom</td>
                                    <td style='width:1%'>:</td>
                                    <td style='width:70%'>` + data[0].trans_id + `</td>
                                </tr>
                                <tr>
                                    <td style='width:20%'>Nama Produk</td>
                                    <td style='width:1%'>:</td>
                                    <td>` + data[0].produk + `</td>
                                </tr>
                                <tr>
                                    <td style='width:20%'>Keterangan</td>
                                    <td style='width:1%'>:</td>
                                    <td>` + data[0].keterangan + `</td>
                                </tr>
                            </table>
                            <div class='text-right'>
                                <small><i>*Disajikan Dalam Rupiah</i></small>
                            </div>
                            <table class='table table-bordered table-sm'>
                                <thead>
                                    <tr style="background-color: #4361ee; color: #fff">
                                        <th class='text-center' style='width:5%'>No</th>
                                        <th class='text-center' style='width:10%'>Kode</th>
                                        <th>Nama</th>
                                        <th class='text-center' style='width:10%'>Qty</th>
                                        <th class='text-center' style='width:10%'>Unit</th>
                                    </tr>
                                </thead>`
                    var detail = data[0].details
                    var no = 1
                    for (let i = 0; i < detail.length; i++) {
                        html += `<tr>
                            <td class='text-center'>` + no++ + `</td>
                            <td>` + detail[i].material_id + `</td>
                            <td>` + detail[i].material_name + `</td>
                            <td class='text-center'>` + detail[i].qty + `</td>
                            <td class='text-center'>` + detail[i].material_unit + `</td>
                        </tr>`

                    }
                    html += `</table> </div> </div>`
                    $('#previewHere').html(html);
                }
            })
        }

        function destroy(id) {
            console.log('hapus data');
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data " + id + " Akan dihapus secara permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '<?= base_url('transaksi/bom/delete/') ?>' + id,
                        dataType: 'JSON',
                        success: (data) => {
                            console.log(data);
                            Swal.fire({
                                title: data.title,
                                icon: data.type,
                                text: data.message,
                                buttonsStyling: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3f37c9',
                            });
                            loadData()
                        },
                        error: (err) => {

                        }
                    });
                }
            })
        }

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