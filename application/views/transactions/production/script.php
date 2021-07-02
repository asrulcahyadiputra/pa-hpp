<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        function format_number(x) {
            return new Intl.NumberFormat('de-DE').format(x)
        }


        $('#kode_pesanan').on('change', function(e) {
            var id = $('#kode_pesanan').val()
            // console.log(id)
            load_product(id)
        })

        $('#form-bom').on('submit', function(e) {
            e.preventDefault()
            var form_data = $('#form-bom').serialize();
            var rowCount = $('#table-opsi-bom >tbody >tr').length
            if (rowCount > 0) {
                load_bb(form_data)
            } else {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'Gagal Load Data',
                    buttonsStyling: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3f37c9',
                })
            }
        })

        $('#production-form').on('submit', function(e) {
            e.preventDefault()
            var form_data = $('#production-form').serialize()
            var btklCount = $('#tbl_posts_btkl >tbody >tr').length
            var bopCount = $('#tbl_posts_bop >tbody >tr').length
            if (btklCount > 0 || bopCount > 0) {
                simpan(form_data)
            } else {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'BTKL tidak Valid',
                    buttonsStyling: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3f37c9',
                })
            }
        })

        function simpan(data) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('transaksi/produksi/store') ?>',
                data: data,
                dataType: 'JSON',
                success: function(res) {
                    Swal.fire({
                        title: res.title,
                        icon: res.icon,
                        text: res.text,
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                    $('#bbb').html('')
                    $('#table-opsi-bom >tbody >tr').remove()
                    $('#tbl_posts_bop >tbody >tr').remove()
                    $('#tbl_posts_btkl >tbody >tr').remove()
                    resetForm()
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Internal Server Error',
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                    $('#table-opsi-bom >tbody >tr').remove()
                }
            })
        }


        function load_product(id) {
            var html = ''
            $.ajax({
                type: 'GET',
                url: '<?= base_url('transaksi/produksi/find_product/') ?>' + id,
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
                    if (data.length > 0) {
                        var no = 1
                        for (let i = 0; i < data.length; i++) {
                            html += `<tr>
                            <td class='text-center'>` + no++ + `</td>
                            <td><input name='product_id[]' class='form-control' value='` + data[i].product_id + `' form='form-bom' readonly></td>
                            <td><input name='product_name[]' class='form-control' value='` + data[i].product_name + `' form='form-bom' readonly></td>
                            <td><input name='order_size[]' class='form-control' value='` + data[i].order_size + `' form='form-bom' readonly></td>
                            <td><input name='order_qty[]' class='form-control' value='` + data[i].order_qty + `' form='form-bom' readonly></td>
                            <td>`
                            var opsi = data[i].opsi
                            html += `<select class='form-control' name='kode_bom[]'  form='form-bom' required>`
                            html += `<option value=''>pilih bom</option>`
                            for (let y = 0; y < opsi.length; y++) {
                                html += `<option value='` + opsi[y].trans_id + `'> ` + opsi[y].trans_id + '-' + opsi[y].description + ` </option>`
                            }
                            html += `</select>`
                            html += `</td>
                        </tr>`
                        }

                        $('#table-opsi-bom >tbody').html(html)
                    } else {
                        $('#table-opsi-bom >tbody >tr').remove()
                    }


                },
                error: function(error) {
                    console.log(error)
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Data Tidak DItemukan',
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                    $('#table-opsi-bom >tbody >tr').remove()
                }

            })
        }


        function load_bb(data) {

            $.ajax({
                type: 'POST',
                url: '<?= base_url('transaksi/produksi/load') ?>',
                data: data,
                dataType: 'JSON',
                success: function(res) {
                    console.log(res.bom)
                    var data = res.bom
                    var html = ''
                    var total_bb = 0
                    var total_bp = 0
                    for (let y = 0; y < data.length; y++) {
                        html += `<table class='table table-bordered table-sm mt-3'>
                        <thead>
                            <tr style="background-color: #4361ee; color: #fff">
                                <th style='width:5%' class='text-center'>No</th>
                                <th style='width:10%'>Kode</th>
                                <th style='width:30%'>Nama</th>
                                <th class='text-center' style='width:10%'>Jenis</th>
                                <th style='width:5%' class='text-center'>Qty</th>
                                <th style='width:5%' class='text-center'>Satuan</th>
                                <th  class='text-right' style='width:15%'>Harga Satuan</th>
                                <th class='text-right'>Jumlah</th>
                            </tr>

                            <input type='hidden' class='form-control' name='kode_bom_post[]' value="` + data[y].kode_bom + `" readonly>
                            <input type="hidden" class='form-control' name='qty_post[]' value="` + data[y].order_qty + `" readonly>



                        </thead>
                        <tbody>`


                        var no = 1
                        var total = 0
                        var t_bp = 0
                        var t_bb = 0
                        var detail = data[y].details
                        var qty = data[y].order_qty
                        for (let i = 0; i < detail.length; i++) {
                            var jumlah = parseInt(qty * detail[i].qty)
                            var subtotal = parseInt(jumlah * detail[i].avg_price)
                            html += `<tr>
                            <td class='text-center'>` + no++ + `</td>
                            <td>` + detail[i].material_id + `</td>
                            <td>` + detail[i].material_name + `</td>
                            <td class='text-center'>` + detail[i].material_type + `</td>
                            <td class='text-center'>` + parseInt(qty * detail[i].qty) + `</td>
                            <td class='text-center'>` + detail[i].material_unit + `</td>
                            <td class='text-right'>` + format_number(detail[i].avg_price) + `</td>
                            <td class='text-right'>` + format_number(subtotal) + `</td>

                        </tr>`
                            if (detail[i].material_type == 'BBB') {
                                t_bb = t_bb + subtotal
                            } else {
                                t_bp = t_bp + subtotal
                            }
                            total = total + subtotal
                        }
                        total_bb = total_bb + t_bb
                        total_bp = total_bp + t_bp
                        html += `</tbody><tfoot>
                            <tr>
                                <th class='text-right' colspan="7">Total BB</th>
                                <th class='text-right'>` + format_number(t_bb) + `</th>
                            </tr>
                            <tr>
                                <th class='text-right' colspan="7">Total BP</th>
                                <th class='text-right'>` + format_number(t_bp) + `</th>
                            </tr>
                            <tr>
                                <th class='text-right' colspan="7">Total</th>
                                <th class='text-right'>` + format_number(total) + `</th>
                            </tr>
                        </tfoot> </table>`
                        html += `<div style='background-color:#f8f9fa' class='col-12 mt-4'>
                            <span>&nbsp;</span>
                        </div>`

                    }
                    html += `<table class='table table-borderd table-sm'>
                        <tr>
                            <th style='width:70%' class='text-right'>Total Biaya Bahan Baku</th>
                            <th class='text-right'><input class='form-control' name='total_bb' value="` + format_number(total_bb) + `" readonly></th>
                        </tr>
                        <tr>
                            <th style='width:70%' class='text-right'>Total Biaya Bahan Penolong</th>
                            <th class='text-right'><input class='form-control' name='total_bp' value="` + format_number(total_bp) + `" readonly></th>
                        </tr>
                    </table>`

                    $('#bbb').html(html)
                }
            })
        }

        function resetForm() {
            document.getElementById("form-production").reset();
        }
    })
</script>

<!-- BTKL FORM -->
<script type="text/javascript">
    jQuery(document).delegate('a.add-record-btkl', 'click', function(e) {
        console.log("add row")
        e.preventDefault();
        var content = jQuery('#sample_table_btkl tr'),
            size = jQuery('#tbl_posts_btkl >tbody >tr').length + 1,
            element = null,
            element = content.clone();

        element.attr('id', 'rec-btkl-' + size);
        element.find('.delete-record-btkl').attr('data-id', size);
        element.appendTo('#tbl_posts_body_btkl');
        element.find('.sn').html(size);
    });

    jQuery(document).delegate('a.delete-record-btkl', 'click', function(e) {
        e.preventDefault();
        // var didConfirm = confirm("Data Tidak dapat dikembalikan, Anda yakin ?");

        var id = jQuery(this).attr('data-id');
        var targetDiv = jQuery(this).attr('targetDiv');
        jQuery('#rec-btkl-' + id).remove();

        //regnerate index number on table
        $('#tbl_posts_body_btkl tr').each(function(index) {
            //alert(index);
            $(this).find('span.sn').html(index + 1);
        });
        return true;

    });
</script>



<!-- BTKL BOP -->
<script type="text/javascript">
    jQuery(document).delegate('a.add-record-bop', 'click', function(e) {
        console.log("add row")
        e.preventDefault();
        var content = jQuery('#sample_table_bop tr'),
            size = jQuery('#tbl_posts_bop >tbody >tr').length + 1,
            element = null,
            element = content.clone();

        element.attr('id', 'rec-bop-' + size);
        element.find('.delete-record-bop').attr('data-id', size);
        element.appendTo('#tbl_posts_body_bop');
        element.find('.sn').html(size);
    });

    jQuery(document).delegate('a.delete-record-bop', 'click', function(e) {
        e.preventDefault();
        // var didConfirm = confirm("Data Tidak dapat dikembalikan, Anda yakin ?");

        var id = jQuery(this).attr('data-id');
        var targetDiv = jQuery(this).attr('targetDiv');
        jQuery('#rec-bop-' + id).remove();

        //regnerate index number on table
        $('#tbl_posts_body_bop tr').each(function(index) {
            //alert(index);
            $(this).find('span.sn').html(index + 1);
        });
        return true;

    });
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