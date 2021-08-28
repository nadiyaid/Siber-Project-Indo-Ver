<div id="approved<?php echo $row['absen_id']; ?>" class="modal fade approved" role="dialog">
    <div class="appRequest modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Ubah Data Presensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="approve-query.php" method="POST">
                <div class="modal-body">
                    <div class="reqinfo">
                        <input class="form-control" type="hidden" name="absen_id" value="<?php echo $row['absen_id']; ?>">
                        
                        <div class="form-group row">
                            <label class="col-form-label col-3">Nama</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="nama" id="nama" value="<?php echo $row['nama']; ?>">
                            </div>
                        </div>       
                        <div class="form-group row">
                            <label class="col-form-label col-3">Posisi</label>
                            <div class="col-9">
                                <select class="form-control" name="posisi" id="posisi" disabled>
                                    <option value="<?php echo $row['posisi']; ?>"><?php echo $row['posisi']; ?></option>                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-3">Status Kehadiran</label>
                            <div class="col-9">
                                <select class="form-control" name="status" id="status">
                                    <option value="<?php echo $row['stat']; ?>"><?php echo $row['stat']; ?></option>
                                    <?php
                                        $q_subt = mysqli_query($config, "SELECT DISTINCT stat FROM absensi");
                                        while ($data_subt = mysqli_fetch_array($q_subt)) {
                                    ?>
                                        <option value="<?php echo $data_subt['stat']; ?>"><?php echo $data_subt['stat']; ?></option>
                                    <?php
                                        }  
                                    ?>                             
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="app-button d-flex">
                        <button type="button" class="btn btn-close" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="decline" onclick="alert('Data berhasil diubah');">Ubah</button>
                    </div>
                    <script>
                            function decline(anchor) {
                                var r = confirm("Apakah Anda yakin ingin menolak permohonan ini?");
                                if (r) {
                                    window.location=anchor.attr("href");
                                }
                            }
                    </script>
                </div>                              
            </form>
        </div>
    </div>
</div>