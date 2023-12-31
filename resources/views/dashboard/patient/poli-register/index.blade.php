@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Tabel Data
                </h4>

                <div class="d-flex align-items-center">
                    <a href="/pasien/mendaftar-poli/create">
                        <button class="btn btn-gradient-primary">
                            <i class="bi bi-plus-square"></i>
                            Tambah Data
                        </button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover dt-responsive datatable">
                    <thead class="text-center">
                        <tr>
                            <th>
                                No
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Nama Poli
                            </th>

                            <th>
                                Nama Dokter
                            </th>

                            <th>
                                Nomor Antrian
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Aksi
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ url('/pasien/mendaftar-poli/datatable') }}",
            columnDefs: [{
                targets: "_all",
                className: 'text-center',
            }],
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                {
                    data: 'poliRegisterDateCustom',
                    name: 'poliRegisterDateCustom'
                },

                {
                    data: 'poliNameCustom',
                    name: 'poliNameCustom'
                },

                {
                    data: 'doctorNameCustom',
                    name: 'doctorNameCustom'
                },

                {
                    data: 'queueNumberCustom',
                    name: 'queueNumberCustom'
                },

                {
                    data: 'statusCustom',
                    name: 'statusCustom'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                paginate: {
                    previous: 'Sebelumnya',
                    next: 'Selanjutnya'
                }
            },
        });
    </script>
@endsection
