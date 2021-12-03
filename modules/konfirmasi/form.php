<script type="text/javascript">
  function tampil_transaksi(input) {
    var num = input.value;

    $.post("modules/konfirmasi/pembelian.php", {
      datakodetransaksi: num,
    }, function(response) {
      $('#tglpembelian').html(response)
      $('#namaobat').html(response)

      document.getElementById('jumlah_keluar').focus();
    });
  }

  function cek_jumlah_keluar(input) {
    jml = document.formObatKeluar.jumlah_beli.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
      alert('Jumlah keluar Tidak Boleh Nol !!');
      input.value = input.value.substring(0, input.value.length - 1);
    }
  }

  function sum() {
    var jumlah_beli = document.getElementById('jumlah_beli').value;
    var harga_jual = document.getElementById('harga_jual').value;
    var total = parseInt(jumlah_beli) * harga_jual;

    if (!isNaN(total)) {
      document.getElementById('nominal').value = total;

    }

  }

  function hitung_total_harga() {
    bil1 = document.formObatKeluar.harga_beli.value;
    bil2 = document.formObatKeluar.jumlah_beli.value;

    if (bil2 == "") {
      var hasil = "";
    } else {
      var hasil = eval(bil1) * eval(bil2);
    }

    document.formObatKeluar.total_harga.value = (hasil);
  }
</script>

<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
  <!-- tampilan form add data -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-edit icon-title"></i> Konfirmasi Pesanan
    </h1>
    <ol class="breadcrumb">
      <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
      <li><a href="?module=obat_keluar"> Konfirmasi Pesanan </a></li>
      <li class="active"> Tambah </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!-- form start -->
          <form role="form" class="form-horizontal" action="modules/obat-keluar/proses.php?act=insert" method="POST" name="formObatKeluar">
            <div class="box-body">
              <?php
              // // fungsi untuk membuat kode transaksi
              // $query_id = mysqli_query($mysqli, "SELECT RIGHT(kode_transaksi,7) as kode FROM is_obat_keluar
              //                                   ORDER BY kode_transaksi DESC LIMIT 1")
              //   or die('Ada kesalahan pada query tampil kode_transaksi : ' . mysqli_error($mysqli));

              // $count = mysqli_num_rows($query_id);

              // if ($count <> 0) {
              //   // mengambil data kode transaksi
              //   $data_id = mysqli_fetch_assoc($query_id);
              //   $kode    = $data_id['kode'] + 1;
              // } else {
              //   $kode = 1;
              // }

              // // buat kode_transaksi
              // $tahun          = date("Y");
              // $buat_id        = str_pad($kode, 7, "0", STR_PAD_LEFT);
              // $kode_transaksi = "TK-$tahun-$buat_id";
              ?>

              <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <select class="chosen-select" name="kode_transaksi" data-placeholder="-- Pilih Kode Transaksi --" onchange="tampil_transaksi(this)" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                    $query_obat = mysqli_query($mysqli, "SELECT kode_transaksi, nama_obat, tanggal_pembelian, harga,jumlah_beli,total_harga FROM tb_pembelian ORDER BY kode_transaksi ASC")
                      or die('Ada kesalahan pada query tampil transaksi: ' . mysqli_error($mysqli));
                    while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                      echo "<option value=\"$data_obat[kode_transaksi]\"> $data_obat[kode_transaksi] | $data_obat[kode_transaksi] </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Kode Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="kode_transaksi" value="<?php echo $kode_transaksi; ?>" readonly required>
                </div>
              </div> -->

              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Pilih Tanggal Transaksi</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                </div>
              </div> -->

              <hr>



              <span id='tglpembelian'>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Pembelian</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="tglpembelian" name="tglpembelian" readonly="">
                  </div>
                </div>
              </span>


              <!-- <span id='namaobat'>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Obat</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="namaobat" name="namaobat" readonly="">
                  </div>
                </div>
              </span> -->

              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Jumlah Beli</label>
                <div class="col-sm-5">
                  <input type="number" class="form-control" id="jumlah_beli" name="jml_beli" required="">
                </div>
              </div> -->

              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Total Harga</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" onkeyup="sum();" id="nominal" name="total" readonly="">
                </div>
              </div> -->

            </div><!-- /.box body -->

            <div class="box-footer">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <a href="?module=obat_keluar" class="btn btn-default btn-reset">Batal</a>
                </div>
              </div>
            </div><!-- /.box footer -->
          </form>
        </div><!-- /.box -->
      </div>
      <!--/.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
<?php
}
?>