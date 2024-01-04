@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Ubah Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/dokter/riwayat-pasien">
                        <button class="btn btn-gradient-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="medicalRecordNumber">
                        Nomor RM
                    </label>

                    <input type="text" class="form-control" name="medicalRecordNumber" id="medicalRecordNumber"
                        value="{{ $poliRegister->patient->medical_record_number }}" placeholder="Masukan Nomor RM"
                        autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="name">
                        Nama
                    </label>

                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ $poliRegister->patient->name }}" placeholder="Masukan Nama" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="complaint">
                        Keluhan
                    </label>

                    <textarea class="form-control" name="complaint" id="complaint" placeholder="Masukan Keluhan" autocomplete="off"
                        cols="30" rows="5" readonly>{{ $poliRegister->complaint }}</textarea>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="note">
                        Catatan
                    </label>

                    <textarea class="form-control" name="note" id="note" placeholder="Masukan Catatan" autocomplete="off"
                        cols="30" rows="5" readonly>{{ $checkup->note }}</textarea>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="medicineId">
                        Obat
                    </label>

                    <input type="text" class="form-control" name="medicineId" id="medicineId"
                        value="{{ $checkupDetail->medicine->name }}" placeholder="Masukan Obat" autocomplete="off" readonly>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="fee">
                        Biaya
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            Rp
                        </span>

                        <input type="text" class="form-control" name="fee" id="fee"
                            value="{{ FormatterCustom::formatNumber($checkup->checkup_fee + $checkupDetail->medicine->price) }}"
                            onkeypress="return inputNumber()" placeholder="Masukan Biaya" autocomplete="off" readonly>
                    </div>
                </div>

                <div class="mb-1">
                    <label class="form-label" for="poliRegisterDate">
                        Tanggal Periksa
                    </label>

                    <input type="text" class="form-control" name="poliRegisterDate" id="poliRegisterDate"
                        value="{{ FormatterCustom::formatDate($poliRegister->poli_register_date) }}"
                        placeholder="Masukan Tanggal Periksa" autocomplete="off" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection
