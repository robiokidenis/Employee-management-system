@extends('layouts.theme.template')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Employees</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Employees</li>
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
                                    <th>Full name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
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
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="input_first_name" name="first_name" placeholder="First Name">
                            <span class="invalid-feedback" id="err-msg-first_name" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" id="input_last_name" name="last_name" placeholder="last Name">
                            <span class="invalid-feedback" id="err-msg-last_name" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="_email">Email address</label>
                            <input type="email" class="form-control" name="email" id="input_email" placeholder="Enter email">
                            <span class="invalid-feedback" id="err-msg-email" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="website">Phone</label>
                            <input type="text" class="form-control" id="input_phone" name="phone" placeholder="phone url">
                            <span class="invalid-feedback" id="err-msg-phone" role="alert"></span>
                        </div>
                        <div class="form-group">
                          <label for="">Company</label>
                          <select class="form-control" name="company" id="input_company">
                            @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                          </select>
                          <span class="invalid-feedback" id="err-msg-phone" role="alert"></span>
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
    <div class="modal fade" id="modal-view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Company Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-addnew">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="view_name" name="name" placeholder="Company name">
                            <span class="invalid-feedback" id="err-msg-name" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="_email">Email address</label>
                            <input type="email" class="form-control" name="email" id="view_email" placeholder="Enter email">
                            <span class="invalid-feedback" id="err-msg-email" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="website">Websitte</label>
                            <input type="text" class="form-control" id="view_website" name="website" placeholder="website url">
                            <span class="invalid-feedback" id="err-msg-website" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Logo</label>
                            <img id="company-logo" src="" alt="company logo" class="img-thumbnail mt-2" width="100px" height="100px">
                        </div>



                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button"  data-dismiss="modal" class="btn btn-primary">Ok</button>
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
            url: "{{route('employees.index')}}",
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
                data: 'full_name'
            },
            {
                data: 'email'
            }, {
                data: 'phone'
            }, {
                data: 'company'
            }, {
                data: 'action',
                "searchable": false,
                "orderable": false,
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
        $('#submit-addnew').text('Save');
        $('#submit-addnew').removeAttr("disabled");
    }



    $('#btnAdd').on('click', function(e) {
        e.preventDefault();
        refreshData();
        $('#modal-add > div > div > div > .modal-title').text('Add New Employee');
        $('input[name=_method]').val('POST');
        $('#submit-addnew').attr('name', 0);
        $('#modal-add').modal({
            backdrop: 'static',
            show: true
        });
    });
    $(document).on('click', '.view-company', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: "{{url('companies')}}/" + id + "/edit",
            dataType: "json",
            type: 'GET',
            success: function(data) {
                console.log(data);
                $.each(data.data, function(key, value) {
                    $('#view_' + key).val(value).attr('disabled',true);
                    if(key=='logo'){
                        $('#company-logo').attr('src',"{{asset('/storage')}}/"+value);
                    }
                });
                $('#modal-view').modal({
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
    $(document).on('click', '.edit-employees', function(e) {
        // refreshData();
        var id = $(this).data('id');
        console.log(id);
        // $('input[name=_method]').val('PATCH');
        $('#modal-add > div > div > div > .modal-title').text('Edit Employee');
        $('#submit-addnew').attr('name', 1);
        $('#submit-addnew').val(id);
        $.ajax({
            url: "{{url('employees')}}/" + id + "/edit",
            dataType: "json",
            type: 'GET',
            success: function(data) {
                console.log(data);
                $.each(data, function(key, value) {
                    $('#input_' + key).val(value);
                    console.log(key +' '+value);
                });
                $('#modal-add').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            },
            error: function(data) {
                alert('Ooops, something wrong!, please try again');
                console.log('Error:', data);
            }
        })
    });
    $('#submit-addnew').on('click', function(e) {
        e.preventDefault();
        var URL = "{{route('employees.store')}}",
            METHOD = "POST";
        if ($(this).attr('name') == 1) {
            URL = "{{url('employees')}}/" + $(this).val();
            METHOD = "PUT"
        }
       $.ajax({
            type: METHOD,
            url: URL,
            data: $('#form-addnew').serialize(), //+ "&department=" + department,
            beforeSend: function() {
                $('#submit-addnew').text('Loading...');
                $('#submit-addnew').attr("disabled",true);
            },
            success: function(response) {
                console.log(response);
            },
            complete: function(response) {
                console.log(response);
                $('#submit-addnew').text('Save');
                $('#submit-addnew').removeAttr("disabled");
                if (response.status == '201') {
                    swal("Successfull", "Successfull input employee.", "success");
                    refreshData();
                } else if ((response.status == '200')) {
                    console.log(response.status);
                    swal("Successfull", "Successfull update employee.", "success");
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

    $(document).on('click', '.delete-employees', function(e) {
        // refreshData();

        var id = $(this).data('id');
        e.preventDefault();

        swal({
                title: "Are you sure?",
                text: "want to delete this employee data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // if (confirm("Are You sure want to delete !?")) {
                    $.ajax({
                        url: "{{url('employees')}}/" + id,
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