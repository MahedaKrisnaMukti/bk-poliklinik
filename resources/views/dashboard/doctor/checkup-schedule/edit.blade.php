@extends('layouts.main')

@section('content')
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Tambah Data
                </h4>
            </div>

            <div class="card-body">
                <div class="mb-1">
                    <a href="/dokter/jadwal-periksa">
                        <button class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </button>
                    </a>
                </div>

                <form id="formSubmit" method="POST"
                    action="/dokter/jadwal-periksa/{{ Crypt::encrypt($checkupSchedule->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="mb-1">
                        <label class="form-label" for="day">
                            Hari
                        </label>

                        <select class="form-control select2" name="day" id="day">
                            @if ($checkupSchedule)
                                <option value="{{ $checkupSchedule->day }}">
                                    {{ $checkupSchedule->day }}
                                </option>

                                @if ($checkupSchedule->day != 'Senin')
                                    <option value="Senin">
                                        Senin
                                    </option>
                                @endif

                                @if ($checkupSchedule->day != 'Selasa')
                                    <option value="Selasa">
                                        Selasa
                                    </option>
                                @endif

                                @if ($checkupSchedule->day != 'Rabu')
                                    <option value="Rabu">
                                        Rabu
                                    </option>
                                @endif

                                @if ($checkupSchedule->day != 'Kamis')
                                    <option value="Kamis">
                                        Kamis
                                    </option>
                                @endif

                                @if ($checkupSchedule->day != 'Jumat')
                                    <option value="Jumat">
                                        Jumat
                                    </option>
                                @endif

                                @if ($checkupSchedule->day != 'Sabtu')
                                    <option value="Sabtu">
                                        Sabtu
                                    </option>
                                @endif
                            @else
                                <option value="">
                                    Pilih salah satu
                                </option>

                                <option value="Senin">
                                    Senin
                                </option>

                                <option value="Selasa">
                                    Selasa
                                </option>

                                <option value="Rabu">
                                    Rabu
                                </option>

                                <option value="Kamis">
                                    Kamis
                                </option>

                                <option value="Jumat">
                                    Jumat
                                </option>

                                <option value="Sabtu">
                                    Sabtu
                                </option>
                            @endif

                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="startTime">
                            Jam Mulai
                        </label>

                        <input type="text" class="form-control custom-timepicker" name="startTime" id="startTime"
                            value="{{ $checkupSchedule ? $checkupSchedule->start_time : '' }}"
                            placeholder="Masukan Jam Mulai" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="endTime">
                            Jam Selesai
                        </label>

                        <input type="text" class="form-control custom-timepicker" name="endTime" id="endTime"
                            value="{{ $checkupSchedule ? $checkupSchedule->end_time : '' }}"
                            placeholder="Masukan Jam Selesai" autocomplete="off">
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="status">
                            Status
                        </label>

                        <select class="form-control select2" name="status" id="status">
                            <option value="{{ $checkupSchedule->status }}">
                                {{ $checkupSchedule->status }}
                            </option>

                            @if ($checkupSchedule->status != 'Aktif')
                                <option value="Aktif">
                                    Aktif
                                </option>
                            @endif

                            @if ($checkupSchedule->status != 'Tidak Aktif')
                                <option value="Tidak Aktif">
                                    Tidak Aktif
                                </option>
                            @endif
                        </select>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                        <i class="bi bi-check2-circle"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $('#formSubmit').submit(function(e) {
            let status = validate();
            let form = this;
            e.preventDefault();

            if (status) {
                confirmSubmit(form);
            }
        });

        function validate() {
            const day = $('#day');
            const startTime = $('#startTime');
            const endTime = $('#endTime');
            const status = $('#status');

            if (day.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Pilih hari terlebih dahulu !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (startTime.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Jam mulai tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (endTime.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Jam selesai tidak boleh kosong !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            if (status.val() == '') {
                Swal.fire({
                    icon: "error",
                    text: "Pilih status jadwal terlebih dahulu !",
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-gradient-primary',
                    },
                });

                return false;
            }

            return true;
        }
    </script>
@endsection
