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
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        Companies Data
                    </div>


                    <div class="card-body">
                        <button type="button" class="btn btn-default" id="btnAdd">
                            Launch Default Modal
                        </button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Website</th>
                                    <th>Options</th>
                                    <!-- <th style="width: 40px">Label</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Companies Name</td>
                                    <td>Email</td>
                                    <td>Logo</td>
                                    <td>Website</td>

                                    <td class="text-center"><span class="badge bg-success">Edit</span> <span class="badge bg-danger">Delete</span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
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
                            <input type="email" class="form-control" name="input_email" id="input_email" placeholder="Enter email">
                            <span class="invalid-feedback" id="err-msg-email" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="website">Websitte</label>
                            <input type="text" class="form-control" id="input_website" name="website" placeholder="website url">
                            <span class="invalid-feedback" id="err-msg-website" role="alert"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo" id="input_logo">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    <span class="invalid-feedback" id="err-msg-logo" role="alert"></span>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->


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
@section('script')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function refreshData() {
        $('.modal').modal('hide');
        $('.form-group>input').removeClass('is-invalid');
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

    $('#submit-addnew').on('click', function(e) {
        e.preventDefault();
        var URL = $(this).attr('name') == 1 ? "{{url('companies')}}/" + $(this).val() : "{{route('companies.store')}}";

        $.ajax({
            type: "POST",
            url: URL,
            data: $('#form-addnew').serialize(), //+ "&department=" + department,
            beforeSend: function() {
                $(this).text('Loading...');
                $(this).attr("disabled", '');
            },
            success: function(response) {
                console.log(response);
            },
            complete: function(response) {
                console.log(response);
                $(this).text('Save');
                $(this).removeAttr("disabled");

                if (response.status == '201') {
                    // showAlert('Successfull Input attendace record');
                    refreshData();
                } else if ((response.status == '200')) {
                    console.log(response.status);
                    // showAlert('Successfull update data.');
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
                    // showAlert('Ooops, something wrong!, please try again', 2);
                    console.log('Error:', e);
                }
            }
        });

        // refreshData();
    });
</script>
@endsection