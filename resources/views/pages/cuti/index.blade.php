@extends('layouts.app')

@section('title', 'Cuti')

@push('after_style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 justify-content-between d-flex">
                <h6>Daftar Cuti</h6>
                <button id="addBtn" class="btn btn-success btn-sm btn-edit">Ajukan Cuti</button>
            </div>
            <div class="card-body p-2 px-4 pb-4">
                <div class="table-responsive p-0">
                    <table id="cutiTable" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Induk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Cuti</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lama Cuti</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
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


@include('pages.cuti.modal')

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
            return $('#cutiTable').DataTable({
                data: data,
                columns: [
                    { data: 'id' },
                    { data: 'nomor_induk' },
                    { data: 'tanggal_cuti' },
                    { data: 'lama_cuti' },
                    { data: 'keterangan' },
                ],
                destroy: true,
            });
        }

        axios({
            method: 'get',
            url: baseUrl+'cuti',
            headers: {
                'Authorization': 'Bearer ' + getAccessToken(),
                'Accept': 'application/json',
            },
        })
        .then(function (response) {
            var table = datatable(response.data.data);

            $('#addBtn').on('click', function () {
                openModal();
            });

            $('#cutiForm').submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);

                var url = baseUrl+'cuti';
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
                    $('#cutiModal').modal('hide');
                    updateDatatable(); //reload table
                    showSuccessAlert('Data saved successfully!');
                })
                .catch(function (error) {
                    console.error(error);
                });
            });

            function openModal(data = null) {
                $('#cutiForm')[0].reset();

                axios({
                    method: 'get',
                    url: baseUrl+'karyawan',
                    headers: {
                        'Authorization': 'Bearer ' + getAccessToken(),
                        'Accept': 'application/json',
                    },
                })
                .then(function (response) {
                    $.each(response.data.data, function(index, data) {
                        $('#nomor_induk').append($('<option>').text(data.nomor_induk +' | '+data.nama).attr('value', data.nomor_induk));
                    });
                })
                .catch(function (error) {
                    console.error(error);
                });

                $('#cutiModal').modal('show');
            }

            function updateDatatable() {
                axios({
                    method: 'get',
                    url: baseUrl+'cuti',
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
