@extends('layouts.app')

@section('content')
<input type="text" hidden id="id-delete">

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
                            <input type="text" class="form-control" name="pembayaran" id="pembayaran" placeholder="xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="dynamicTable" class="table table-bordered table-striped" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Buruh</th>
                                    <th>Persentase</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Buruh 0</td>
                                    <td>
                                        <input type="text" id="buruhs0" name="buruhs" value="" hidden>
                                        <input type="text" name="buruh[0][persen]" placeholder="%"
                                            class="form-control" onblur="findTotal1()" onkeyup="hitungPersentase1(0), setBuruhs(0)" maxlength="2"/>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add" class="btn btn-success">Add</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <input hidden type="text" name="total1" id="total1" placeholder="xxxxxxxxxx">

                    <hr>

                    <div id="dynamicTable2">
                        <div class="form-group row mb-3">
                            <label class="col-sm-2">Buruh 0</label>
                            <div class="col-sm-8 ">
                                <p name="text_buruh_0" id="text_buruh_0">xxxxxxxxxx</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-simpan1">Save</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Modal View --}}
<div class="modal fade" id="viewDataBuruh" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewDataBuruhLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="viewDataBuruhLabel">View Data Buruh</h3>
                <button id="btnClose1" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" onclick="clearData()"></button>
            </div>

            <div class="modal-body text-center">
                <div class="form-group row mb-3">
                    <div class="col-sm-12 input-data">
                        <h3><b>Pembayaran</b></h3><br>
                        <h1 name="view_pembayaran" id="view_pembayaran"></h1>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="dynamicTableView" class="table table-bordered table-striped" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Buruh</th>
                                <th>Persentase</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                            <input type="text" class="form-control" name="edit_pembayaran" id="edit_pembayaran" placeholder="xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="dynamicTableEdit" class="table table-bordered table-striped" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>Buruh</th>
                                    <th>Persentase</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
    var i = 0;

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

            var x = document.getElementById('total1').value;
            if (x == 100) {
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
                var atextA = document.getElementById("view_pembayaran").innerHTML = "Rp." + data[0].pembayaran;

                $.each(data, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.buruh),
                        $('<td>').text(item.persentase + '%'),
                        $('<td>').text('Rp.' + item.hasil)
                    ).appendTo('#dynamicTableView');
                });
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
                $('#edit_id').val(data[0].id_data_buruh);

                $('#edit_pembayaran').val(data[0].pembayaran);

                $.each(data, function(i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.buruh),
                        $('<td>').text(item.persentase + '%'),
                        $('<td>').text('Rp.' + item.hasil)
                    ).appendTo('#dynamicTableEdit');
                });
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
        var table1 = $("#dynamicTableEdit").on("draw.dt", function () {
            $(this).find(".dataTables_empty").parents('tbody').empty();
        }).DataTable().clear().draw();
        var table1 = $("#dynamicTableView").on("draw.dt", function () {
            $(this).find(".dataTables_empty").parents('tbody').empty();
        }).DataTable().clear().draw();
    }
    
    {{-- Cara Hitung Persen --}}
    function hitungPersentase1(id) {
        var pem = document.getElementById("pembayaran").value;
        var data = document.getElementsByName("buruh["+id+"][persen]")[0].value;
        var dataA = (data / 100) * pem;
        var textA = document.getElementById("text_buruh_" + id).innerHTML = dataA;
    }

    function setBuruhs(id) {
        var data = document.getElementsByName("buruh["+id+"][persen]")[0].value;
        var data1 = document.getElementById("buruhs" + id).value = data;
    }

    function findTotal1(){
        var arr = document.getElementsByName('buruhs');
        var tot=0;
        for(var i=0;i<arr.length;i++){
            if(parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        document.getElementById('total1').value = tot;
    }

    {{-- Buruh Dinamis --}}
    $("#add").click(function () {
        ++i;
        $("#dynamicTable").append(
            '<tr>' +
                '<td>Buruh ' + i + '</td>' +
                '<td>' +
                    '<input type="text" id="buruhs'+i+'" name="buruhs" value="" hidden>' +
                    '<input type="text" name="buruh[' + i + '][persen]" placeholder="%" class="form-control" onblur="findTotal1()" onkeyup="hitungPersentase1(' + i + '), setBuruhs(' + i + ')" maxlength="2"/>' +
                '</td>' +
                '<td>' +
                    '<button type="button" class="btn btn-danger remove-tr" onclick="removes1(' + i + ')">Remove</button>' +
                '</td>' +
            '</tr>'
        );

        $("#dynamicTable2").append(
            '<div class="rms' + i + ' form-group row mb-3">' +
                '<label class="col-sm-2">Buruh ' + i + '</label>' +
                '<div class="col-sm-8 ">' +
                    '<p name="text_buruh_' + i + '" id="text_buruh_' + i + '">xxxxxxxxxx</p>' +
                '</div>' +
            '</div>'
        );
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
    });

    function removes1(id) {
        const elements = document.getElementsByClassName('rms' + id);
        while(elements.length > 0){
            elements[0].parentNode.removeChild(elements[0]);
        }
    }
</script>
@endsection