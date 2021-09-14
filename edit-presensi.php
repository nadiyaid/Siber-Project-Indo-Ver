<!------------------- EDIT presensi modal ----------------------->
<div class="modal fade" id="editPresensi<?php echo $row['absen_id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data Presensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="edit-presensi-query.php" method="POST">
                <div class="modal-body">                                                    
                    <div class="pb-3">
                        <input class="form-control" type="hidden" name="absen_id" id="id" value="<?php echo $row['absen_id']; ?>">
                        <span class="bi bi-calendar-date"><text-muted> <?php echo date("l, d M Y", strtotime($row['tanggal']));?></span>
                    </div>
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
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-3">Status Kehadiran</label>
                        <div class="col-9">
                            <select class="form-control" name="status" id="status">
                                <option value="<?php echo $row['stat']; ?>"></option>
                                <option value="late">Terlambat</option>
                                <option value="absent">Absen</option>
                                <option value="">Hadir</option>
                            </select>
                        </div>
                    </div>                                             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-close" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="edit" class="btn btn-primary" onclick="alert('Data berhasil diubah');">Ubah</a>
                </div>
            </form>
        </div>
    </div>
</div>