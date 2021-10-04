@extends('layouts.theme.template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Companies</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Companies</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-sm" id="btnAdd"> Add New</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableCompanies" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-addnew">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="input_name" name="name" placeholder="Company name">
                            <span class="invalid-feedback" id="err-msg-name" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="_email">Email address</label>
                            <input type="email" class="form-control" name="email" id="input_email" placeholder="Enter email">
                            <span class="invalid-feedback" id="err-msg-email" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="website">Websitte</label>
                            <input type="text" class="form-control" id="input_website" name="website" placeholder="website url">
                            <span class="invalid-feedback" id="err-msg-website" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" class="form-control-file" name="image" id="input_image" placeholder="" aria-describedby="fileHelpId">
                            <span class="invalid-feedback" id="err-msg-image" role="alert"></span>
                        </div>



                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="submit-addnew" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@endsection

@section('customStyles')

<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#tableCompanies").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        ajax: {
            url: "{{route('companies.index')}}",
            data: {
                from_date: "",
            }
        },
        columns: [{
                data: 'DT_RowIndex',
                "searchable": false,
                "orderable": false,
                name: 'no'
            }, {
                data: 'name'
            },
            {
                data: 'email'
            }, {
                data: 'website'
            }, {
                data: 'logo'
            }, {
                data: 'action',
                // "searchable": false,
                // "orderable": false,
            }


        ],
        dom: 'Bftip',
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableCompanies_wrapper .col-md-6:eq(0)');


    function refreshData() {
        $('#tableCompanies').dataTable().fnDraw(false);
        $('#tableCompanies').DataTable().ajax.reload();
        $("#form-addnew").trigger("reset");
        $('.modal').modal('hide');
        $('.form-group>input').removeClass('is-invalid');
    }


    function loadData() {

    }

    $('#btnAdd').on('click', function(e) {

        e.preventDefault();
        refreshData();
        $('input[name=_method]').val('POST');
        $('.modal-title').text('INPUT COMPANIES');
        $('#submit-addnew').attr('name', 0);
        $('#modal-add').modal({
            backdrop: 'static',
            show: true
        });
    });
    $(document).on('click', '.edit-companies', function(e) {
        // refreshData();

        var id = $(this).data('id');
        $('input[name=_method]').val('PATCH');
        $('.modal-title.modal-add').text('Edit mpp');
        $('#submit-addnew').attr('name', 1);
        $('#submit-addnew').val(id);
        $.ajax({
            url: "{{url('companies')}}/" + id + "/edit",
            dataType: "json",
            type: 'GET',
            success: function(data) {
                console.log(data);
                $.each(data.data, function(key, value) {
                    $('#input_' + key).val(value);
                });
                $('#modal-add').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            },
            error: function(data) {
                alert('Ooops, something wrong!, please try again');
                console.log('Error:', data.responseJSON);
            }
        })
    });
    $('#submit-addnew').on('click', function(e) {
        e.preventDefault();
        var URL = "{{route('companies.store')}}",
            METHOD = "POST";
        if ($(this).attr('name') == 1) {
            URL = "{{url('companies')}}/" + $(this).val();
            METHOD = "POST"
        }
        var form = $('#form-addnew')[0];
        var data = new FormData(form);
        console.log(data);
        $.ajax({
            data: data,
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            type: METHOD,
            url: URL,
            // data: form, // $('#form-addnew').serialize(), //+ "&department=" + department,
            beforeSend: function() {
                $('#submit-addnew').text('Loading...');
                $('#submit-addnew').attr("disabled", '');
            },
            success: function(response) {
                console.log(response);
            },
            complete: function(response) {
                console.log(response);
                $('#submit-addnew').text('Save');
                $('#submit-addnew').removeAttr("disabled");
                if (response.status == '201') {
                    swal("Successfull", "Successfull input companies", "success");
                    refreshData();
                } else if ((response.status == '200')) {
                    console.log(response.status);
                    swal("Successfull", "Successfull update companies", "success");
                    refreshData();
                }
            },
            error: function(e) {
                var e = e.responseJSON;
                if (e.errors) {
                    $.each(e.errors, function(key, value) {
                        $('#input_' + key).addClass('is-invalid');
                        $('#err-msg-' + key).text(value);
                    })
                } else {
                    swal(
                        'Oops...',
                        'Something went wrong!',
                        'error'
                    )
                    console.log('Error:', e);
                    refreshData();
                }
            }
        });
    });

    $(document).on('click', '.delete-companies', function(e) {
        // refreshData();

        var id = $(this).data('id');
        e.preventDefault();

        swal({
                title: "Are you sure?",
                text: "want to delete this company data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // if (confirm("Are You sure want to delete !?")) {
                    $.ajax({
                        url: "{{url('companies')}}/" + id,
                        type: 'DELETE',
                        data: {
                            'id': id,
                        },
                        success: function(data) {
                            console.log(data);
                            refreshData();
                            swal("company has been deleted!", {
                                icon: "success",
                            });
                        },
                        error: function(data) {
                            console.log('Error:', data.responseJSON);
                            swal(
                                'Oops...',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    });
                    // }

                } else {
                    //cancelled
                }
            });
    });
</script>
@endsection