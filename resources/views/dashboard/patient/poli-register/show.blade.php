@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Detail Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/pasien/mendaftar-poli">
                        <button class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        No. RM
                    </label>

                    <input type="text" class="form-control" name="poliName" id="poliName"
                        value="{{ $poliRegister->patient->medical_record_number }}" placeholder="Masukan Nama Poli"
                        autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nama Poli
                    </label>

                    <input type="text" class="form-control" name="poliName" id="poliName"
                        value="{{ $checkupSchedule->poli->name }}" placeholder="Masukan Nama Poli" autocomplete="off"
                        readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Tanggal
                    </label>

                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ FormatterCustom::formatDate($poliRegister->poli_register_date) }}"
                        placeholder="Masukan Nama" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nama Dokter
                    </label>

                    <input type="text" class="form-control" name="poliName" id="poliName"
                        value="{{ $checkupSchedule->doctor->name }}" placeholder="Masukan Nama Poli" autocomplete="off"
                        readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Jadwal Periksa
                    </label>

                    <input type="text" class="form-control" name="poliName" id="poliName"
                        value="{{ $checkupSchedule->start_time }} - {{ $checkupSchedule->end_time }}"
                        placeholder="Masukan Nama Poli" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nomor Antrian
                    </label>

                    <input type="text" class="form-control" name="poliName" id="poliName"
                        value="{{ $poliRegister->queue_number }}" placeholder="Masukan Nama Poli" autocomplete="off"
                        readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Status
                    </label>

                    <input type="text" class="form-control" name="poliName" id="poliName"
                        value="{{ $poliRegister->status }}" placeholder="Masukan Nama Poli" autocomplete="off" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection
