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
                            <h5>Filter Page</h5>

                            <div class="row">
                               
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Date range:</label>
    
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservation">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_email">Email address</label>
                                        <input type="text" class="form-control" name="email" id="filter_email"
                                            placeholder="Enter email">
                                        <span class="invalid-feedback" id="err-msg-filter_email" role="alert"></span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" id="filter_first_name" name="first_name"
                                            placeholder="First Name">
                                        <span class="invalid-feedback" id="err-msg-filter_irst_name" role="alert"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" id="filter_last_name" name="last_name"
                                            placeholder="last Name">
                                        <span class="invalid-feedback" id="err-msg-filter_last_name" role="alert"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_company">Company</label>
                                        <select class="form-control" name="company" id="filter_company">
                                            <option value=""></option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback" id="err-msg-filter_company" role="alert"></span>
                                    </div>
                                </div>
                                <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                            </div>
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
                                <input type="text" class="form-control" id="input_first_name" name="first_name"
                                    placeholder="First Name">
                                <span class="invalid-feedback" id="err-msg-first_name" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control" id="input_last_name" name="last_name"
                                    placeholder="last Name">
                                <span class="invalid-feedback" id="err-msg-name" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="_email">Email address</label>
                                <input type="email" class="form-control" name="email" id="input_email"
                                    placeholder="Enter email">
                                <span class="invalid-feedback" id="err-msg-email" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="website">Phone</label>
                                <input type="text" class="form-control" id="input_phone" name="phone"
                                    placeholder="phone url">
                                <span class="invalid-feedback" id="err-msg-phone" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Company</label>
                                <select class="form-control" name="company" id="input_company">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" id="err-msg-input_company" role="alert"></span>
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
                                <input type="text" class="form-control" id="view_name" name="name"
                                    placeholder="Company name">
                                <span class="invalid-feedback" id="err-msg-name" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="_email">Email address</label>
                                <input type="email" class="form-control" name="email" id="view_email"
                                    placeholder="Enter email">
                                <span class="invalid-feedback" id="err-msg-email" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="website">Websitte</label>
                                <input type="text" class="form-control" id="view_website" name="website"
                                    placeholder="website url">
                                <span class="invalid-feedback" id="err-msg-website" role="alert"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Logo</label>
                                <img id="company-logo" src="" alt="company logo" class="img-thumbnail mt-2" width="100px"
                                    height="100px">
                            </div>



                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Ok</button>
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

    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection
@section('script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var filter_from, filter_to, filter_email, filter_first_name,
            filter_last_name,
            filter_company;


        //Date range as a button
        $('#reservation').daterangepicker({
                // ranges: {
                //     'Today': [moment(), moment()],
                //     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                //     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                //     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                //     'This Month': [moment().startOf('month'), moment().endOf('month')],
                //     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                //         'month')]
                // },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                filter_from = start.format('YYYY-MM-DD');
                filter_to = end.format('YYYY-MM-DD');
                console.log(filter_from, filter_to);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        // $('#filter_from').on('change', function() {
        //     console.log("masuk gan");
        // });


        $("#btn-filter").on("click", function() {
            // filter_from = filter_from;
            // filter_to = filter_to;
            filter_email = $('#filter_email').val();
            filter_first_name = $('#filter_first_name').val();
            filter_last_name = $('#filter_last_name').val();
            filter_company = $('#filter_company').val();
            // $('#tableCompanies').dataTable().fnDraw(false);
            // $('#tableCompanies').DataTable().ajax.reload();
            load_dtable(true);
        });
        load_dtable();

        function load_dtable(reinitial = false, filter_comp = null) {
            if (reinitial) {
                $('#tableCompanies').DataTable().destroy();
            }
            $("#tableCompanies").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('employees.index') }}",
                    data: {
                        filter_from: filter_from,
                        filter_to: filter_to,
                        filter_email: filter_email,
                        filter_first_name: filter_first_name,
                        filter_last_name: filter_last_name,
                        filter_company: filter_company,
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
        }



        function refreshData() {
            // $('#tableCompanies').dataTable().fnDraw(false);
            // $('#tableCompanies').DataTable().ajax.reload();
            load_dtable(true);
            $("#form-addnew").trigger("reset");
            $('.modal').modal('hide');
            $('.form-group>input').removeClass('is-invalid');
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
            // refreshData();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('companies') }}/" + id + "/edit",
                dataType: "json",
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data.data, function(key, value) {
                        $('#view_' + key).val(value).attr('disabled', true);
                        if (key == 'logo') {
                            $('#company-logo').attr('src', "{{ asset('/storage') }}/" +
                                value);
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
                url: "{{ url('employees') }}/" + id + "/edit",
                dataType: "json",
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $.each(data, function(key, value) {
                        $('#input_' + key).val(value);
                        console.log(key + ' ' + value);
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
            var URL = "{{ route('employees.store') }}",
                METHOD = "POST";
            if ($(this).attr('name') == 1) {
                URL = "{{ url('employees') }}/" + $(this).val();
                METHOD = "PUT"
            }
            // var form = $('#form-addnew')[0];
            // var data = new FormData(form);
            // console.log(data);
            $.ajax({
                // data: data,
                // enctype: 'multipart/form-data',
                // processData: false, // Important!
                // contentType: false,
                // cache: false,
                type: METHOD,
                url: URL,
                data: $('#form-addnew').serialize(), //+ "&department=" + department,
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
                    }
                }
            });

            // refreshData();
        });

        $(document).on('click', '.delete-employees', function(e) {
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
                            url: "{{ url('employees') }}/" + id,
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
