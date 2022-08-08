<div class="container-fluid mb-5">

    <div class="row">
        <div class="col">
            <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
        </div>
    </div>
    <?php 
    // var_dump($mahasiswa);
    ?>
    <form action="<?= base_url("Admin/tambahBeasiswa") ?>" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="selectNama">Nama Mahasiswa</label>
                    <select class="form-control" id="nama" name="nama" required>
                        <option value="" disabled selected>Select Name</option>
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
                    <label for="selectBeasiswa">Tipe Beasiswa</label>
                    <select class="form-control" id="tipeBeasiswa" name="tipe" required>
                        <option value="" disabled selected>Select Type Scholarship</option>
                        <option value="Internal">Internal</option>
                        <option value="Eksternal">Eksternal</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="jenisBeasiswa">Jenis Beasiswa</label>
                    <input type="text" name="jenis" class="form-control" id="jenisBeasiswa" aria-describedby="jenisHelp" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="namaBeasiswa">Nama Beasiswa</label>
                    <input type="text" name="namaBeasiswa" class="form-control" id="namaBeasiswa" aria-describedby="namaBeasiswaHelp" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="tahunBeasiswa">Tahun Beasiswa</label>
                    <input type="text" name="tahunBeasiswa" class="form-control" id="tahunBeasiswa" aria-describedby="tahunHelp" required>
                    <small id="tahunHelp" class="form-text text-muted">Example: 2021/2022</small>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="<?= base_url('Admin/') ?>" type="button" class="btn btn-secondary">Cancel</a>

            </div>
        </div>

    </form>

</div>