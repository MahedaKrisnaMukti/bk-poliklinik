@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-start">
                    <h4 class="card-title">
                        Tabel Data
                    </h4>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/admin/dokter/create">
                        <button class="btn btn-primary">
                            <i class="bi bi-plus-square"></i>
                            Tambah Data
                        </button>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered datatable">
                        <thead class="text-center">
                            <tr>
                                <th>
                                    No
                                </th>

                                <th>
                                    Poli
                                </th>

                                <th>
                                    Nama
                                </th>

                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <form id="formDelete" method="POST" action="/admin/dokter/">
                @method('delete')
                @csrf
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: "{{ url('/admin/dokter/datatable') }}",
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
                    data: 'poliCustom',
                    name: 'poliCustom'
                },

                {
                    data: 'name',
                    name: 'name'
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
