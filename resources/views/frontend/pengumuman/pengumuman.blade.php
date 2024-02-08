@extends('frontend.index-form')
@section('judul','Pengumuman')
@section('link_judul_halaman1','/pengumuman')
@section('nama_link_judul_halaman1','Halaman Pengumuman')
@section('content')


<style>
    .countdown-container {
        display: flex;
        flex-direction: column;
        /* Ubah menjadi column agar h5 dan countdown-wrapper berada di bawah satu sama lain */
        justify-content: center;
        align-items: center;

    }

    .countdown-wrapper {
        display: flex;
        flex-direction: row;
        margin-top: 5px;

        /* Ini akan menyusun kotak-kotak waktu secara horizontal */
    }

    .countdown-box {

        background-color: #f4f4f4;
        border: 2px solid #333;
        padding: 12px;
        margin: 10px;
        font-size: 1.5rem;
        text-align: center;

    }

    .countdown-label {
        font-size: 0.8rem;
        color: #666;
    }
</style>
<section id="pengumuman" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 entries">
                @if($pengumuman->count() > 0)
                @foreach($pengumuman as $item)
                <div class="section-title text-center">
            <h2>Halaman Pengumuman</h2>
            <p>Dibawah ini adalah pengumuman hasil kelulusan siswa yang sesuai dengan persyaratan.</p>
        </div>
                <article class="entry">
                    <div id="countdown-container-{{ $item->id }}" class="entry-img text-center countdown-container mb-3 mt-3">
                        <h5 class="text-center" id="tanggal-{{ $item->id }}" style="margin-bottom: 10px;">Pengumuman dapat diakses pada tanggal ( {{ \Carbon\Carbon::parse($item->tanggal_pengumuman)->format('d-m-Y')  }} ) pukul ( {{ \Carbon\Carbon::parse($item->tanggal_pengumuman)->format('H:i')  }} wib )</h5>

                        <div class="countdown-wrapper">
                            <div id="days-{{ $item->id }}" class="countdown-box"></div>
                            <div id="hours-{{ $item->id }}" class="countdown-box"></div>
                            <div id="minutes-{{ $item->id }}" class="countdown-box"></div>
                            <div id="seconds-{{ $item->id }}" class="countdown-box"></div>
                        </div>
                    </div>

                    <h2 class="entry-title text-center">
                        <h2 class="entry-title text-center">
                            <a id="link-pengumuman-{{ $item->id }}" href="/pengumuman">{{ $item->judul_pengumuman }}</a>
                        </h2>
                    </h2>
                    <div class="entry-content">
                        <p class="text-center">{{ Str::limit($item->keterangan, 300) }}</p>

                        <div id="pengumuman-container-{{ $item->id }}" style="display: none;">
                            <p class="text-center">Silahkan klik tombol di bawah ini untuk melihat pengumuman atau print pengumuman.</p>
                            <div class="text-center lihat-pengumuman">
                                <a href="{{ url('pengumuman/' . $item->id) }}" class="btn btn-primary btn-lg"><i class="bi bi-eye"></i> Lihat Detail Pengumuman</a>
                                <!-- <a href="{{ url('pengumuman/print/' . $item->id) }}" class="btn btn-secondary btn-lg"><i class="bi bi-printer"></i> Print Hasil Pengumuman</a> -->
                            </div>
                        </div>

                    </div>

                </article>
                @endforeach
                @else
                <div class="text-center mt-5 mb-5">
                    <h4>Belum ada informasi pengumuman</h4>
                    <p>Harap tunggu informasi selanjutnya!</p>
                </div>
                @endif
                <!-- End of loop -->
            </div>
        </div>
    </div>
</section>


<script>
    function startCountdown(targetDate, containerId) {
        function updateCountdown() {
            var now = new Date().getTime();
            var distance = targetDate - now;

            // Jika sudah mencapai atau melewati tanggal pengumuman
            if (distance <= 0) {
                clearInterval(interval);
                document.getElementById('countdown-container-' + containerId).style.display = 'none'; // Sembunyikan countdown
                document.getElementById('pengumuman-container-' + containerId).style.display = 'block'; // Tampilkan pengumuman
                document.getElementById('link-pengumuman-' + containerId).href = "{{ url('pengumuman') }}/" + containerId; // Ganti href

                return;
            }

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('days-' + containerId).innerHTML = days + "<div class='countdown-label'>Hari</div>";
            document.getElementById('hours-' + containerId).innerHTML = hours + "<div class='countdown-label'>Jam</div>";
            document.getElementById('minutes-' + containerId).innerHTML = minutes + "<div class='countdown-label'>Menit</div>";
            document.getElementById('seconds-' + containerId).innerHTML = seconds + "<div class='countdown-label'>Detik</div>";
        }

        updateCountdown(); // Panggil fungsi ini sekali untuk inisialisasi
        var interval = setInterval(updateCountdown, 1000); // Update setiap detik
    }



    @foreach($pengumuman as $item)
    var targetDate = new Date('{{ $item->tanggal_pengumuman }}').getTime();
    startCountdown(targetDate, '{{ $item->id }}');
    @endforeach


    function checkDateAndShowAnnouncement(targetDate, containerId) {
        var now = new Date().getTime();
        if (now >= targetDate) {
            // Jika sudah mencapai atau melewati tanggal pengumuman
            document.getElementById('countdown-container-' + containerId).style.display = 'none'; // Sembunyikan countdown
            document.getElementById('pengumuman-container-' + containerId).style.display = 'block'; // Tampilkan pengumuman
        }
    }

    // Panggil fungsi ini dalam loop pengumuman Anda, mirip dengan startCountdown
    @foreach($pengumuman as $item)
    var targetDate = new Date('{{ $item->tanggal_pengumuman }}').getTime();
    checkDateAndShowAnnouncement(targetDate, '{{ $item->id }}');
    @endforeach

</script>
@endsection
