<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(e) {
        function format_number(x) {
            return new Intl.NumberFormat('de-DE').format(x)
        }
        $('#filter-section').show()
        $('#report-section').hide()
        $('#btn-close-filter').hide()
        $('#btn-submit-filter').show()
        $('#btn-open-filter').hide()


        $('#form-filter').on('submit', function(e) {
            e.preventDefault()
            var periode = $('#periode').val()
            if (periode == '') {
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: "Mohon Mengisi Periode Terlebih Dahulu!",
                    buttonsStyling: true,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3f37c9',
                })
            } else {
                $.ajax({
                    type: 'GET',
                    url: '<?= base_url('laporan/hpp/load_report/') ?>' + periode,
                    dataType: 'JSON',
                    success: function(res) {
                        var html = ''
                        $('#periode-section').html(res.periode)
                        html += `<div class='text-right'><small><i>*Disajikan Dalam Rupiah</i></small></div>`
                        var detail = res.values
                        console.log(detail)
                        if (detail.length > 0) {
                            var biaya_produksi = parseInt(detail[0].bbb) + parseInt(detail[0].btkl) + parseInt(detail[0].bop)
                            html += `<table class='table table-hover table-sm mt-3'>
                                <tr>
                                    <td><b>Persediaan Barang Dalam Proses Awal</b></td>
                                    <td></td>
                                    <td>` + format_number(res.bdp_aw) + `</td>
                                </tr>
                                <tr>
                                    <td><b>Biaya Produksi:</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Bahan Baku</td>
                                    <td>` + format_number(detail[0].bbb) + `</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Tenaga Kerja Langsung</td>
                                    <td>` + format_number(detail[0].btkl) + `</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Biaya Overhead Pabrik</td>
                                    <td>` + format_number(detail[0].bop) + `</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Total Biaya Produksi</b></td>
                                    <td></td>
                                    <td><b>` + format_number(biaya_produksi) + `</b></td>
                                </tr>
                                <tr>
                                    <td><b>Persediaan Barang Dalam Proses Akhir</b></td>
                                    <td></td>
                                    <td>` + format_number(res.bdp_ak) + `</td>
                                </tr>
                                <tr style='background-color: #ced4da'>
                                    <td><b>Harga Pokok Produksi</b></td>
                                    <td></td>
                                    <td><b>` + format_number(biaya_produksi) + `</b></td>
                                </tr>
                        
                            </table>`
                        } else {
                            html += `<div class='text-center'>
                                <img src='<?= base_url('assets/img/no-data.png') ?>' style='width:15%' />
                                <h6>Data Tidak Ditemukan</h6>
                            </div>`
                        }


                        $('#report-body-section').html(html)
                        // set section
                        $('#filter-section').hide()
                        $('#report-section').show()
                        $('#btn-close-filter').hide()
                        $('#btn-submit-filter').hide()
                        $('#btn-open-filter').show()
                    },
                    error: function(err) {
                        Swal.fire({
                            title: '500',
                            icon: 'error',
                            text: "Internal Server Error",
                            buttonsStyling: true,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3f37c9',
                        })
                    }
                })

            }
        })

        // button filter set

        $('#btn-close-filter').on('click', function(e) {
            e.preventDefault()
            console.log('close filter')
            $('#filter-section').hide()
            $('#report-section').show()
            $('#btn-close-filter').hide()
            $('#btn-submit-filter').hide()
            $('#btn-open-filter').show()
        })

        $('#btn-open-filter').on('click', function(e) {
            e.preventDefault()
            $('#filter-section').show()
            $('#report-section').show()
            $('#btn-close-filter').show()
            $('#btn-submit-filter').show()
            $('#btn-open-filter').hide()
        })

    })
</script>