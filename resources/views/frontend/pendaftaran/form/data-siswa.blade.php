<div class="row">
    <div class="col-md-6 form-group">
        <label for="nik" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nomor Induk Kependudukan (NIK)<span class="required-star">*</span></label>
        <input type="number" name="nik" class="form-control" id="nik" placeholder="NIK">
        <div id="error-nik" class="text-danger" style="display: none;"></div>
    </div>

    <div class="col-md-6 form-group mt-3 mt-md-0">
        <label for="nama" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Nama Lengkap<span class="required-star">*</span></label>
        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
        <div id="error-nama" style="color: red; display: none;"></div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6 form-group">
        <label for="jenis_kelamin" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Jenis Kelamin<span class="required-star">*</span></label>
        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
            <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <div id="error-jenis_kelamin" class="text-danger" style="display: none;"></div>
    </div>

    <div class="col-md-6 form-group mt-3 mt-md-0">
        <label for="agama" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Agama<span class="required-star">*</span></label>
        <select name="agama" class="form-control" id="agama">
            <option value="" disabled selected>Pilih Agama</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
        </select>
        <div id="error-agama" class="text-danger" style="display: none;"></div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6 form-group">
        <label for="tempat_lahir" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Tempat Lahir<span class="required-star">*</span></label>
        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" id="tempat_lahir">
        <div id="error-tempat_lahir" class="text-danger" style="display: none;"></div>
    </div>

    <div class="col-md-6 form-group mt-3 mt-md-0">
        <label for="tanggal_lahir" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Tanggal Lahir<span class="required-star">*</span></label>
        <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control flatpickr-input tanggal_lahir" placeholder="Tanggal Lahir">
        <div id="error-tanggal_lahir" class="text-danger" style="display: none;"></div>
    </div>

</div>

<div class="row mt-3">
    <div class="col-md-6 form-group">
        <label for="jumlah_saudara" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Jumlah Saudara<span class="required-star">*</span></label>
        <input type="number" name="jumlah_saudara" id="jumlah_saudara" class="form-control" placeholder="Jumlah Saudara">
        <div id="error-jumlah_saudara" class="text-danger" style="display: none;"></div>
    </div>

    <div class="col-md-6 form-group mt-3 mt-md-0">
        <label for="anak_ke" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Anak ke berapa<span class="required-star">*</span></label>
        <input type="number" name="anak_ke" class="form-control" id="anak_ke" placeholder="Anak Ke">
        <div id="error-anak_ke" class="text-danger" style="display: none;"></div>
    </div>
</div>

<div class="form-group mt-3">
    <label for="alamat" class="form-label" style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Alamat Rumah<span class="required-star">*</span></label>
    <textarea class="form-control" name="alamat" rows="5" id="alamat" placeholder="Alamat"></textarea>
    <div id="error-alamat" class="text-danger" style="display: none;"></div>
</div>
