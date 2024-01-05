@extends('layouts.app')

@section('title', 'Karyawan')

@push('after_style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 justify-content-between d-flex">
                <h6>Daftar Semua Karyawan</h6>
                <button id="addBtn" class="btn btn-success btn-sm btn-edit">Tambah Data</button>
            </div>
            <div class="card-body p-2 px-4 pb-4">
                <div class="table-responsive p-0">
                    <table id="karyawanTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Induk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Bergabung</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- Data akan diisi oleh DataTables --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('pages.karyawan.modal')

@endsection

@push('after_style')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    function getAccessToken() {
        return localStorage.getItem('access_token');
    }

    if (!getAccessToken()) {
        window.location.href = '/login';
    }

    var baseUrl = 'http://127.0.0.1:8000/api/';

    $(document).ready(function () {
        function datatable(data) {
            return $('#karyawanTable').DataTable({
                data: data,
                columns: [
                    { data: 'id' },
                    { data: 'nomor_induk' },
                    { data: 'nama' },
                    { data: 'alamat' },
                    { data: 'tanggal_lahir' },
                    { data: 'tanggal_bergabung' },
                    {
                        data: 'action',
                        render: function (data) {
                            return '<button class="btn btn-primary mt-2 btn-edit"><i class="fa-solid fa-pen-to-square"></i></button> <button class="btn btn-danger mt-2 btn-delete"><i class="fa-solid fa-trash"></i></button>';
                        }
                    }
                ],
                destroy: true,
            });
        }

        axios({
            method: 'get',
            url: baseUrl+'karyawan',
            headers: {
                'Authorization': 'Bearer ' + getAccessToken(),
                'Accept': 'application/json',
            },
        })
        .then(function (response) {
            var table = datatable(response.data.data);

            $('#karyawanTable tbody').on('click', '.btn-edit', function () {
                var data = table.row($(this).closest('tr')).data();
                openModal(data);
            });

            $('#karyawanTable tbody').on('click', '.btn-delete', function () {
                var data = table.row($(this).closest('tr')).data();
                deleteEmployee(data.id);
            });

            $('#addBtn').on('click', function () {
                openModal();
            });

            $('#employeeForm').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);

                var url = baseUrl+'karyawan';
                var method = 'POST';

                var employeeId = $('#employeeId').val();
                if (employeeId) {
                    url += '/' + employeeId;
                    method = 'PUT';
                }

                axios({
                    method: method,
                    url: url,
                    data: formData,
                    headers: {
                        'Authorization': 'Bearer ' + getAccessToken(),
                        'Accept': 'application/json',
                    },
                })
                .then(function (response) {
                    console.log(response);
                    $('#employeeModal').modal('hide');
                    updateDatatable(); //reload table
                    showSuccessAlert('Data saved successfully!');
                })
                .catch(function (error) {
                    console.error(error);
                });
            });

            function openModal(data = null) {
                $('#employeeForm')[0].reset();

                $('#employeeModalLabel').html('Tambah Data Karyawan');
                
                if (data) {
                    $('#employeeModalLabel').html('Update Data Karyawan');
                    $('#employeeId').val(data.id);
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#tanggal_bergabung').val(data.tanggal_bergabung);
                }

                $('#employeeModal').modal('show');
            }

            function deleteEmployee(employeeId) {
                axios({
                    method: 'delete',
                    url: baseUrl+'karyawan/' + employeeId,
                    headers: {
                        'Authorization': 'Bearer ' + getAccessToken(),
                        'Accept': 'application/json',
                    },
                })
                .then(function (response) {
                    updateDatatable(); //reload table
                    showSuccessAlert('Data deleted successfully!');
                })
                .catch(function (error) {
                    console.error(error);
                });
            }

            function updateDatatable() {
                axios({
                    method: 'get',
                    url: baseUrl+'karyawan',
                    headers: {
                        'Authorization': 'Bearer ' + getAccessToken(),
                        'Accept': 'application/json',
                    },
                })
                .then(function (response) {
                    table.destroy();
                    table = datatable(response.data.data);
                })
                .catch(function (error) {
                    console.error(error);
                });
            }

            function showSuccessAlert(message) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(function (error) {
            console.error(error);
        });
    });
</script>
@endpush
