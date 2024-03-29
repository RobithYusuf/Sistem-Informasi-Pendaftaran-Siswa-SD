<section id="jadwal" class="pricing">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h2>Jadwal</h2>
            <p>Berikut ini adalah jadwal setiap periode pendaftaran penerimaan siswa didik baru.</p>
        </div>

        <div class="row justify-content-center">
            @foreach($informasi as $info)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 rounded-lg shadow h-100">
                    <div class="card-body d-flex flex-column justify-content-center mt-3">
                        <h3 class="card-title text-center mb-4 card-title-enhanced"><i class="bi bi-megaphone" style="color: #f6b024; margin-right: 10px"></i>{{ $info->kegiatan }}</h3>

                        <p class="card-info-item mb-3"><i class="bi bi-info-circle-fill mr-2" style="color: #f6b024;"></i> {{ $info->deskripsi }}</p>

                        @if($info->tanggal_mulai)
                        <p class="card-info-item mb-2"><i class="bi bi-calendar mr-2" style="color: #f6b024;"></i> <strong>Mulai&nbsp;&nbsp;&nbsp;:&nbsp;</strong> {{ $info->tanggal_mulai->format(' d M Y') }}</p>
                        @endif

                        @if($info->tanggal_selesai)
                        <p class="card-info-item mb-2"><i class="bi bi-calendar-check mr-2" style="color: #f6b024;"></i> <strong>Selesai&nbsp;:&nbsp;</strong> {{ $info->tanggal_selesai->format(' d M Y') }}</p>
                        @endif

                        <div class="mt-auto"></div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>