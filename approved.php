<div id="approved<?php echo $row['request_id']; ?>" class="modal fade approved" role="dialog">
    <div class="appRequest modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Employee Leave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="approve-query.php" method="POST">
                <div class="modal-body">
                    <div class="reqinfo">
                        <input class="form-control" type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <div class="req-header d-flex">
                            <span class="bi bi-calendar-date"><text-muted> <?php echo date("l, d M Y", strtotime($row['tanggal_request']));?></span>
                            <p class="approved">Diterima</p>
                        </div>
                        <div class="form-group d-flex req-date">
                            <div class="fromdate">
                                <label class="col-form-label">Dari:</label>
                                <input type="date" class="form-control" name="from" value="<?php echo $row['dari_tanggal'];?>">
                            </div>
                            <div class="todate">
                                <label class="col-form-label">Sampai:</label>
                                <input type="date" class="form-control" name="to"  value="<?php echo $row['sampai_tanggal'];?>">
                            </div>
                        </div>
                        <label class="col-form-label">Tipe Izin:</label>
                        <div class="form-group radio">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" disabled
                                    <?php if($row['status_ketidakhadiran']=="1") {echo "checked";}?> value="1">
                                <label class="form-check-label">
                                    Izin
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" disabled
                                <?php if($row['status_ketidakhadiran']=="2"){echo "checked";}?> value="2">
                                <label class="form-check-label">
                                    Sakit
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" disabled
                                <?php if($row['status_ketidakhadiran']=="3") {echo "checked";}?> value="3">
                                <label class="form-check-label">
                                    Cuti
                                </label>
                            </div>
                        </div>
                        <div class="form-group keterangan">
                            <label for="message-text" class="col-form-label">Alasan:</label>
                            <textarea class="form-control" readonly><?php echo $row['keterangan'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group pt-1">
                        <label for="message-text" class="col-form-label">Komentar:</label>
                        <textarea class="form-control" placeholder="(Terlihat oleh karyawan)" name="comment"><?php echo $row['comment'];?></textarea>
                    </div>
                    <div class="app-button">
                        <button type="submit" class="btn btn-danger" name="decline" onclick="alert('Request declined');">Tolak</button>
                        

                        <script>
                            function decline(anchor) {
                                var r = confirm("Apakah Anda yakin ingin menolak permohonan ini?");
                                if (r) {
                                    window.location=anchor.attr("href");
                                }
                            }
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-close" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="approve" onclick="alert('Permohonan telah diubah');">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>