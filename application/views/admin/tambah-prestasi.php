<div class="container-fluid mb-5">

    <div class="row">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        </div>
    </div>
    <?php 
    // var_dump($mahasiswa);
    ?>
    <form action="<?= base_url("Admin/tambahPrestasi") ?>" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="selectNama">Nama Mahasiswa</label>
                    <select class="form-control" id="nama" name="nama" required>
                        <option value="" disabled selected>Pilh Mahasiswa</option>
                        <?php foreach ($mahasiswa as $key) :?>
                        <option value="<?= $key['id']; ?>" ><?=$key['nim'].' | '. $key['name']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="selectPeringkat">Peringkat</label>
                    <select class="form-control" id="peringkat" name="peringkat" required>
                        <option value="" disabled selected>Pilih Peringkat</option>
                        <option value="Juara 1">Juara 1</option>
                        <option value="Juara 2">Juara 2</option>
                        <option value="Juara 3">Juara 3</option>
                        <option value="Juara Harapan">Juara Harapan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Individu">Invidu</option>
                        <option value="Kelompok">Kelompok</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="penyelenggara">Penyelenggara</label>
                    <input type="text" name="penyelenggara" class="form-control" id="penyelenggara" aria-describedby="penyelenggaraHelp" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="namaKompetisi">Nama Kompetisi</label>
                    <input type="text" name="namaKompetisi" class="form-control" id="namaKompetisi" aria-describedby="namaKompetisiHelp" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="tahunPrestasi">Tahun Prestasi</label>
                    <input type="text" name="tahun" class="form-control" id="tahun" aria-describedby="tahunHelp" required>
                    <small id="tahunHelp" class="form-text text-muted">Contoh: 2021</small>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success">Kirim</button>
                <a href="<?= base_url('Admin/') ?>" type="button" class="btn btn-secondary">Kembali</a>

            </div>
        </div>

    </form>

</div>