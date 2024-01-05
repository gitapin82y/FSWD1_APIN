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
                <h6>3 Karyawan Pertamakali Gabung</h6>
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

@endsection

@push('after_style')
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
                ],
                destroy: true,
            });
        }

        axios({
            method: 'get',
            url: baseUrl+'karyawan?limit=3',
            headers: {
                'Authorization': 'Bearer ' + getAccessToken(),
                'Accept': 'application/json',
            },
        })
        .then(function (response) {
            var table = datatable(response.data.data);
        })
        .catch(function (error) {
            console.error(error);
        });
    });
</script>
@endpush
