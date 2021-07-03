<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var action_html = '<a href="#" id="btn-edit" class="text-warning"><i class="fa fa-pen"></i></a> <a href="#" id="btn-delete" class="text-danger ml-3"><i class="fa fa-trash"></i></a>'
        var table_menu = $('#table-menu').DataTable({
            "paging": true,
            "ordering": false,
            "info": true,
            "columnDefs": [{
                    "searchable": true,
                    "orderable": false,
                    "targets": 0,
                    "className": 'text-center'
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 6,
                    "data": null,
                    'className': 'text-center',
                    'defaultContent': action_html,
                }
            ],

            "columns": [{
                    data: 'tcode'
                },
                {
                    data: 'menu_name'
                },
                {
                    data: 'url'
                },
                {
                    data: 'menu_icon'
                },
                {
                    data: 'nu'
                },
                {
                    data: 'head_id'
                }

            ]
        })

        // table_menu.on('order.dt search.dt', function() {
        //     table_menu.column(0, {
        //         search: 'applied',
        //         order: 'applied'
        //     }).nodes().each(function(cell, i) {
        //         cell.innerHTML = i + 1;
        //     });
        // }).draw();

        function load_menu() {
            table_menu.clear().draw()
            $.ajax({
                type: 'GET',
                url: '<?= base_url('setting/menu/get_menu') ?>',
                dataType: 'JSON',
                success: function(res) {
                    // console.log(res)
                    table_menu.rows.add(res).draw(false)
                },
                error: function(err) {
                    // console.log(err)
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Internal Server Error',
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                }
            })
        }
        load_menu()

        $('#btn-tambah').on('click', function(e) {
            e.preventDefault()
            $('#form-tambah').attr('form-type', 'store');
            $('#modal-label').html('Tambah Menu Baru')
            $('#addModal').modal('show')
        })

        table_menu.on('click', '#btn-edit', function(e) {
            e.preventDefault()
            var id = $(this).closest('tr').find('td').eq(0).html();
            edit(id)
            $('#form-tambah').attr('form-type', 'update');
            $('#modal-label').html('Edit Menu')
            $('#addModal').modal('show')
        })



        $('#btn-close').on('click', function(e) {
            e.preventDefault
            $('#addModal').modal('hide')
            $("#form-tambah").trigger("reset");
        })

        $('#form-tambah').on('submit', function(e) {
            e.preventDefault()
            var form_type = $(this).attr("form-type")
            if (form_type == 'store') {
                var url = '<?= base_url('setting/menu/store') ?>'
            } else {
                var url = '<?= base_url('setting/menu/update') ?>'
            }

            var form_data = $(this).serialize();
            simpan(form_data, url)

        })

        function resetForm() {
            document.getElementById("#form-tambah").reset();
        }


        function simpan(form_data, url) {
            $.ajax({
                type: 'POST',
                url: url,
                data: form_data,
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
                    $('#addModal').modal('hide')
                    $("#form-tambah").trigger("reset");
                    load_menu()
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText

                    Swal.fire({
                        title: '500',
                        icon: 'error',
                        text: errorMessage,
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                }
            })
        }

        function edit(id) {
            $.ajax({
                type: 'GET',
                url: '<?= base_url('setting/menu/select/') ?>' + id,
                dataType: 'JSON',
                success: function(res) {
                    console.log(res)
                    $('#tcode').val(res.tcode)
                    $('#menu_name').val(res.menu_name)
                    $('#url').val(res.url)
                    $('#menu_icon').val(res.menu_icon)
                    $('#nu').val(res.nu)
                    $('#head_id').val(res.head_id)

                    $('#tcode').prop('readonly', true);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    Swal.fire({
                        title: '500',
                        icon: 'error',
                        text: errorMessage,
                        buttonsStyling: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3f37c9',
                    })
                }
            })
        }

    })
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