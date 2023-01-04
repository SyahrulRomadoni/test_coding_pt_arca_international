@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- Tombol Tambah Data --}}
        <div class="row">
            <div class="col-md-6">
                <h1 class="mt-4">Data Buruh</h1>
                <hr>
                <!-- <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">/Data Buruh/</li>
                </ol> -->
            </div>
            <div class="col-md-6">
                <div class="text-end m-4">
                    <button type="button" class="btn btn-primary" style="width: 60px; height: 60px; border-radius: 100px;"
                        data-bs-toggle="modal" data-bs-target="#tambahDataBuruh">
                        <i style="font-size: 40px;" class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <input type="text" hidden id="id-delete">

        {{-- Tabel --}}
        <div class="row py-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h2 class="text-light">Data Buruh</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbl_data_buruh" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pembayaran</th>
                                        <th>Buruh A</th>
                                        <th>Rupiah A</th>
                                        <th>Buruh B</th>
                                        <th>Rupiah A</th>
                                        <th>Buruh C</th>
                                        <th>Rupiah A</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Modal Add --}}
<div class="modal fade" id="tambahDataBuruh" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tambahDataBuruhLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="tambahDataBuruhLabel">Tambah Data Buruh</h3>
                <button id="btnClose" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" onclick="clearData()"></button>
            </div>

            <form action="" name="form_create" id="form_create" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Pembayaran</label>
                        <div class="col-sm-1 input-data">
                            Rp.
                        </div>
                        <div class="col-sm-8 input-data">
                            <input type="text" class="form-control" name="pembayaran" id="pembayaran" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase1()">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh A</label>
                        <div class="col-sm-3 input-data">
                            <input type="text" class="form-control" name="buruh_a" id="buruh_a" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase1()" maxlength="2">
                        </div>
                        <div class="col-sm-1 input-data">
                            %
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh B</label>
                        <div class="col-sm-3 input-data">
                            <input type="text" class="form-control" name="buruh_b" id="buruh_b" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase1()" maxlength="2">
                        </div>
                        <div class="col-sm-1 input-data">
                            %
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh C</label>
                        <div class="col-sm-3 input-data">
                            <input type="text" class="form-control" name="buruh_c" id="buruh_c" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase1()" maxlength="2">
                        </div>
                        <div class="col-sm-1 input-data">
                            %
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh A</label>
                        <div class="col-sm-8 ">
                            <input hidden type="text" name="rp_a" id="rp_a">
                            <p name="text_buruh_a" id="text_buruh_a">xxxxxxxxxx</p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh B</label>
                        <div class="col-sm-8 ">
                            <input hidden type="text" name="rp_b" id="rp_b">
                            <p name="text_buruh_b" id="text_buruh_b">xxxxxxxxxx</p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh C</label>
                        <div class="col-sm-8 ">
                            <input hidden type="text" name="rp_c" id="rp_c">
                            <p name="text_buruh_c" id="text_buruh_c">xxxxxxxxxx</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-simpan1" disabled>Save</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Modal View --}}
<div class="modal fade" id="viewDataBuruh" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewDataBuruhLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="viewDataBuruhLabel">View Data Buruh</h3>
                <button id="btnClose1" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" onclick="clearData()"></button>
            </div>

            <div class="modal-body">
                <div class="form-group row mb-3">
                    <label class="col-sm-2">Pembayaran</label>
                    <div class="col-sm-8 input-data">
                        <p name="view_pembayaran" id="view_pembayaran"></p>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2">Buruh A</label>
                    <div class="col-sm-3 input-data">
                        <p name="view_buruh_a" id="view_buruh_a"></p>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2">Buruh B</label>
                    <div class="col-sm-3 input-data">
                        <p name="view_buruh_b" id="view_buruh_b"></p>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-sm-2">Buruh C</label>
                    <div class="col-sm-3 input-data">
                        <p name="view_buruh_c" id="view_buruh_c"></p>
                    </div>
                </div>

                <hr>

                <div class="form-group row mb-3">
                    <label class="col-sm-2">Buruh A</label>
                    <div class="col-sm-8 ">
                        <p name="view_text_buruh_a" id="view_text_buruh_a">xxxxxxxxxx</p>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-2">Buruh B</label>
                    <div class="col-sm-8 ">
                        <p name="view_text_buruh_b" id="view_text_buruh_b">xxxxxxxxxx</p>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-sm-2">Buruh C</label>
                    <div class="col-sm-8 ">
                        <p name="view_text_buruh_c" id="view_text_buruh_c">xxxxxxxxxx</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-simpan2">Save</button>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editDataBuruh" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editDataBuruhLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editDataBuruhLabel">Edit Data Buruh</h3>
                <button id="btnClose1" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" onclick="clearData()"></button>
            </div>

            <form action="" name="form_update" id="form_update" method="post" enctype="multipart/form-data">
                @csrf

                <input hidden id="edit_id" type="text" name="id" value="">

                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Pembayaran</label>
                        <div class="col-sm-1 input-data">
                            Rp.
                        </div>
                        <div class="col-sm-8 input-data">
                            <input type="text" class="form-control" name="edit_pembayaran" id="edit_pembayaran" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase2()">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh A</label>
                        <div class="col-sm-3 input-data">
                            <input type="text" class="form-control" name="edit_buruh_a" id="edit_buruh_a" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase2()">
                        </div>
                        <div class="col-sm-1 input-data">
                            %
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh B</label>
                        <div class="col-sm-3 input-data">
                            <input type="text" class="form-control" name="edit_buruh_b" id="edit_buruh_b" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase2()">
                        </div>
                        <div class="col-sm-1 input-data">
                            %
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh C</label>
                        <div class="col-sm-3 input-data">
                            <input type="text" class="form-control" name="edit_buruh_c" id="edit_buruh_c" placeholder="xxxxxxxxxx" onkeyup="hitungPersentase2()">
                        </div>
                        <div class="col-sm-1 input-data">
                            %
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh A</label>
                        <div class="col-sm-8 ">
                            <input hidden type="text" name="edit_rp_a" id="edit_rp_a">
                            <p name="edit_text_buruh_a" id="edit_text_buruh_a">xxxxxxxxxx</p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh B</label>
                        <div class="col-sm-8 ">
                            <input hidden type="text" name="edit_rp_b" id="edit_rp_b">
                            <p name="edit_text_buruh_b" id="edit_text_buruh_b">xxxxxxxxxx</p>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-2">Buruh C</label>
                        <div class="col-sm-8 ">
                            <input hidden type="text" name="edit_rp_c" id="edit_rp_c">
                            <p name="edit_text_buruh_c" id="edit_text_buruh_c">xxxxxxxxxx</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-simpan2">Save</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Modal Konfirmasi Deleted --}}
<div class="modal fade" id="konfirmasiDeleted" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="konfirmasiDeletedLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="konfirmasiDeletedLabel">Konfirmasi Deleted!</h3>
                <button id="btnClose1" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <input hidden id="deleted_id" type="text" name="id" value="">

            <div class="modal-body">
                <div class="form-group row mb-3">
                    <p class="text-center">Apa anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-simpan" data-bs-dismiss="modal"
                    aria-label="Close">Tidak</button>
                    <button type="submit" class="btn btn-danger" id="btn-simpan" onclick="deleteData()">Ya</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var tbl_data_buruh = null;

    {{-- Get Data Tables --}}
    $(function () {
        tbl_data_buruh = $('#tbl_data_buruh').DataTable({
            processing: true,
            serverSide: true,
            sScrollX: "100%",
            sScrollXInner: "110%",
            ajax: "{{ route('home') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pembayaran',
                    render: function (data, type, row) {
                        var pembayaran = row.pembayaran
                        return "Rp. " + pembayaran;
                    }
                },
                {
                    data: 'buruh_a',
                    render: function (data, type, row) {
                        var buruh_a = row.buruh_a
                        return buruh_a + "%";
                    }
                },
                {
                    data: 'rp_a',
                    render: function (data, type, row) {
                        var rp_a = row.rp_a
                        return "Rp. "+ rp_a;
                    }
                },
                {
                    data: 'buruh_b',
                    render: function (data, type, row) {
                        var buruh_b = row.buruh_b
                        return buruh_b + "%";
                    }
                },
                {
                    data: 'rp_b',
                    render: function (data, type, row) {
                        var rp_b = row.rp_b
                        return "Rp. "+ rp_b;
                    }
                },
                {
                    data: 'buruh_c',
                    render: function (data, type, row) {
                        var buruh_c = row.buruh_c
                        return buruh_c + "%";
                    }
                },
                {
                    data: 'rp_c',
                    render: function (data, type, row) {
                        var rp_c = row.rp_c
                        return "Rp. "+ rp_c;
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var id = row.id

                        if (id == null) {
                            return '<td></td>';
                        } else {
                            @if(Auth::user()->id_role == 1)
                            return '<td>' +
                                '<ul class="list-inline m-0">' +
                                '<li class="list-inline-item">' +
                                `<a style="color: white;" class="btn btn-primary" title="Edit" onclick="edit('${id}')"><i class="fa fa-pen"></i></a>` +
                                '</i>' +
                                '<li class="list-inline-item">' +
                                `<a style="color: white;" class="btn btn-warning" title="view" onclick="view('${id}')"><i class="fa fa-eye"></i></a>` +
                                '</i>' +
                                '<li class="list-inline-item">' +
                                `<a style="color: white;" class="btn btn-danger" title="Delete" onclick="konfirmasiDeleted('${id}')"><i class="fa fa-trash"></i></a>` +
                                '</i>' +
                                '</ul>' +
                                '</td>';
                            @else
                            return '<td>' +
                                '<ul class="list-inline m-0">' +
                                '<li class="list-inline-item">' +
                                `<a style="color: white;" class="btn btn-warning" title="view" onclick="view('${id}')"><i class="fa fa-eye"></i></a>` +
                                '</i>' +
                                '</ul>' +
                                '</td>';
                            @endif
                        }

                    }
                },
            ]
        });
    });

    {{-- Create --}}
    $('#form_create').validate({
        rules: {
            Pembayaran: { required: true },
        },
        messages: {
            Pembayaran: { required: "Pembayaran tidak boleh kosong"  },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-data').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            var x = parseInt(document.getElementById("buruh_a").value);
            if (isNaN(x)) x = 0;
            var y = parseInt(document.getElementById("buruh_b").value);
            if (isNaN(y)) y = 0;
            var z = parseInt(document.getElementById("buruh_c").value);
            if (isNaN(z)) z = 0;
            var c = x + y + z;
            if (c == 100) {
                document.getElementById("btn-simpan1").disabled = false;
                var formData = new FormData($("#form_create")[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{route('data_buruh.create')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function ()
                    {
                        $("#btn-simpan1").attr("disabled", true);
                        $("#btn-simpan1").html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                    },
                    success: (data) => {

                        if (data.status == 'success') {
                            swal('Success', data.message, 'success');
                        } else {
                            swal('Error', data.message, 'error');
                        }
                        tbl_data_buruh.ajax.reload();
                        $('#tambahDataBuruh').modal('hide');
                        clearData();

                    },
                    complete: function (xhr) {
                        $("#btn-simpan1").html('Save');
                        $("#btn-simpan1").attr("disabled", false);
                    },
                    error: function (data) {
                        console.log(data);
                        clearData();
                    }
                });
            } else {
                swal('Error', 'Tidak boleh kurang/lebih dari 100%', 'error');
                $("#buruh_a").val("");
                $("#buruh_b").val("");
                $("#buruh_c").val("");
                var textA = document.getElementById("text_buruh_a").innerHTML = "xxxxxxxxxx";
                var textB = document.getElementById("text_buruh_b").innerHTML = "xxxxxxxxxx";
                var textC = document.getElementById("text_buruh_c").innerHTML = "xxxxxxxxxx";
                document.getElementById("btn-simpan1").disabled = true;
            }
        }
    });

    {{-- View --}}
    function view(id) {
        var id = id;
        var url = "{{ route('data_buruh.view') }}";

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (data) {
                $('#viewDataBuruh').modal('show');
                var atextA = document.getElementById("view_pembayaran").innerHTML = "Rp." + data.pembayaran;

                var ptextA = document.getElementById("view_buruh_a").innerHTML = data.buruh_a + "%";
                var ptextB = document.getElementById("view_buruh_b").innerHTML = data.buruh_b + "%";
                var ptextC = document.getElementById("view_buruh_c").innerHTML = data.buruh_c + "%";

                var textA = document.getElementById("view_text_buruh_a").innerHTML = "Rp." + data.rp_a;
                var textB = document.getElementById("view_text_buruh_b").innerHTML = "Rp." + data.rp_b;
                var textC = document.getElementById("view_text_buruh_c").innerHTML = "Rp." + data.rp_c;
            }
        })
    }

    {{-- Edit --}}
    function edit(id) {
        var id = id;
        var url = "{{ route('data_buruh.edit') }}";

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function (data) {
                $('#editDataBuruh').modal('show');
                $('#edit_id').val(data.id);
                $('#edit_pembayaran').val(data.pembayaran);
                $('#edit_buruh_a').val(data.buruh_a);
                $('#edit_buruh_b').val(data.buruh_b);
                $('#edit_buruh_c').val(data.buruh_c);

                var textA = document.getElementById("edit_text_buruh_a").innerHTML = data.rp_a;
                var textB = document.getElementById("edit_text_buruh_b").innerHTML = data.rp_b;
                var textC = document.getElementById("edit_text_buruh_c").innerHTML = data.rp_c;
            }
        })
    }

    {{-- Update --}}
    $('#form_update').validate({
        rules: {
            edit_pembayaran: { required: true },
        },
        messages: {
            edit_pembayaran: { required: "Pembayaran tidak boleh kosong"  },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-data').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            var x = parseInt(document.getElementById("edit_buruh_a").value);
            if (isNaN(x)) x = 0;
            var y = parseInt(document.getElementById("edit_buruh_b").value);
            if (isNaN(y)) y = 0;
            var z = parseInt(document.getElementById("edit_buruh_c").value);
            if (isNaN(z)) z = 0;
            var c = x + y + z;

            if (c == 100) {
                document.getElementById("btn-simpan2").disabled = false;
                var formData = new FormData($("#form_update")[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{route('data_buruh.update')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function ()
                    {
                        $("#btn-simpan2").attr("disabled", true);
                        $("#btn-simpan2").html('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
                    },
                    success: (data) => {

                        if (data.status == 'success') {
                            swal('Success', data.message, 'success');
                        } else {
                            swal('Error', data.message, 'error');
                        }
                        tbl_data_buruh.ajax.reload();
                        $('#editDataBuruh').modal('hide');
                        clearData();
                        
                    },
                    complete: function (xhr) {
                        $("#btn-simpan2").html('Save');
                        $("#btn-simpan2").attr("disabled", false);
                    },
                    error: function (data) {
                        console.log(data);
                        clearData();
                    }
                });
            } else {
                swal('Error', 'Tidak boleh kurang/lebih dari 100%', 'error');
                $("#edit_buruh_a").val("");
                $("#edit_buruh_b").val("");
                $("#edit_buruh_c").val("");
                var textA = document.getElementById("edit_text_buruh_a").innerHTML = "xxxxxxxxxx";
                var textB = document.getElementById("edit_text_buruh_b").innerHTML = "xxxxxxxxxx";
                var textC = document.getElementById("edit_text_buruh_c").innerHTML = "xxxxxxxxxx";
                document.getElementById("btn-simpan2").disabled = true;
            }
        }
    });

    {{-- Delete --}}
    function konfirmasiDeleted(id) {
        $('#konfirmasiDeleted').modal('show');
        $('#deleted_id').val(id);
    }

    function deleteData() {
        var data_id = document.getElementById("deleted_id").value;
        if(data_id !== "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: "{{ route('data_buruh.delete') }}",
                data: {
                    id: data_id
                },
                success: function (data) {
                    $('#konfirmasiDeleted').modal('hide');
                    if (data.status == 'success') {
                        swal('Success', data.message, 'success');
                    } else {
                        swal('Error', data.message, 'error');
                    }
                    tbl_data_buruh.ajax.reload();
                },
                error: function (data) {
                    $('#konfirmasiDeleted').modal('hide');
                    swal('Error', 'Terjadi Kesalahan', 'error');
                }
            });
        } else {
            swal('Error', 'Data tidak bisa di hapus', 'error');
        }
    }

    {{-- Clear Data --}}
    function clearData() {
        $("#pembayaran").val("");
        $("#edit_pembayaran").val("");

        $("#buruh_a").val("");
        $("#edit_buruh_a").val("");

        $("#buruh_b").val("");
        $("#edit_buruh_b").val("");

        $("#buruh_c").val("");
        $("#edit_buruh_c").val("");

        var textA = document.getElementById("text_buruh_a").innerHTML = "xxxxxxxxxx";
        var textB = document.getElementById("text_buruh_b").innerHTML = "xxxxxxxxxx";
        var textC = document.getElementById("text_buruh_c").innerHTML = "xxxxxxxxxx";
        var textA = document.getElementById("edit_text_buruh_a").innerHTML = "xxxxxxxxxx";
        var textB = document.getElementById("edit_text_buruh_b").innerHTML = "xxxxxxxxxx";
        var textC = document.getElementById("edit_text_buruh_c").innerHTML = "xxxxxxxxxx";
    }

    $('.modal').on('hidden.bs.modal', function (e) {
        clearData();
    })

    {{-- Cara Hitung Persen --}}
    function hitungPersentase1() {
        var pem = document.getElementById("pembayaran").value;
        var pBuruhA = document.getElementById("buruh_a").value;
        var pBuruhB = document.getElementById("buruh_b").value;
        var pBuruhC = document.getElementById("buruh_c").value;

        var dataA = (pBuruhA / 100) * pem;
        var textAin = document.getElementById("rp_a").value = dataA;
        var textA = document.getElementById("text_buruh_a").innerHTML = dataA;

        var dataB = (pBuruhB / 100) * pem;
        var textBin = document.getElementById("rp_b").value = dataB;
        var textB = document.getElementById("text_buruh_b").innerHTML = dataB;

        var dataC = (pBuruhC / 100) * pem;
        var textCin = document.getElementById("rp_c").value = dataC;
        var textC = document.getElementById("text_buruh_c").innerHTML = dataC;

        var x = parseInt(document.getElementById("buruh_a").value);
        if (isNaN(x)) x = 0;
        var y = parseInt(document.getElementById("buruh_b").value);
        if (isNaN(y)) y = 0;
        var z = parseInt(document.getElementById("buruh_c").value);
        if (isNaN(z)) z = 0;
        var c = x + y + z;

        if (c == 100) {
            document.getElementById("btn-simpan1").disabled = false;
        } else {
            document.getElementById("btn-simpan1").disabled = true;
        }
    }

    function hitungPersentase2() {
        var pem = document.getElementById("edit_pembayaran").value;
        var pBuruhA = document.getElementById("edit_buruh_a").value;
        var pBuruhB = document.getElementById("edit_buruh_b").value;
        var pBuruhC = document.getElementById("edit_buruh_c").value;

        var dataA = (pBuruhA / 100) * pem;
        var textAin = document.getElementById("edit_rp_a").value = dataA;
        var textA = document.getElementById("edit_text_buruh_a").innerHTML = dataA;

        var dataB = (pBuruhB / 100) * pem;
        var textBin = document.getElementById("edit_rp_b").value = dataB;
        var textB = document.getElementById("edit_text_buruh_b").innerHTML = dataB;

        var dataC = (pBuruhC / 100) * pem;
        var textCin = document.getElementById("edit_rp_c").value = dataC;
        var textC = document.getElementById("edit_text_buruh_c").innerHTML = dataC;

        var x = parseInt(document.getElementById("edit_buruh_a").value);
        if (isNaN(x)) x = 0;
        var y = parseInt(document.getElementById("edit_buruh_b").value);
        if (isNaN(y)) y = 0;
        var z = parseInt(document.getElementById("edit_buruh_c").value);
        if (isNaN(z)) z = 0;
        var c = x + y + z;

        if (c == 100) {
            document.getElementById("btn-simpan2").disabled = false;
        } else {
            document.getElementById("btn-simpan2").disabled = true;
        }
    }
</script>
@endsection