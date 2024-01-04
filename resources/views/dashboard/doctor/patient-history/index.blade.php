@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Tabel Data
                </h4>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover dt-responsive datatable">
                    <thead class="text-center">
                        <tr>
                            <th>
                                No
                            </th>

                            <th>
                                Tanggal Periksa
                            </th>

                            <th>
                                No RM
                            </th>

                            <th>
                                Nama Pasien
                            </th>

                            <th>
                                Catatan
                            </th>

                            <th>
                                Obat
                            </th>

                            <th>
                                Biaya
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
            ajax: "{{ url('/dokter/riwayat-pasien/datatable') }}",
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
                    data: 'medicalRecordNumberCustom',
                    name: 'medicalRecordNumberCustom'
                },

                {
                    data: 'patientNameCustom',
                    name: 'patientNameCustom'
                },

                {
                    data: 'noteCustom',
                    name: 'noteCustom'
                },

                {
                    data: 'medicineNameCustom',
                    name: 'medicineNameCustom'
                },

                {
                    data: 'feeCustom',
                    name: 'feeCustom'
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
