<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var action_html = '<a href="#" id="btn-edit" class="text-warning"><i class="fa fa-pen"></i></a>'
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
                    "targets": 5,
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
            // console.log('show-modal')
            $('#addModal').modal('show')
        })
        $('#btn-close').on('click', function(e) {
            e.preventDefault
            $('#addModal').modal('hide')
            $("#form-tambah").trigger("reset");
        })

        $('#form-tambah').on('submit', function(e) {
            e.preventDefault()
            var form_data = $(this).serialize();
            simpan(form_data)

        })

        function resetForm() {
            document.getElementById("#form-tambah").reset();
        }


        function simpan(form_data) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('setting/menu/store') ?>',
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