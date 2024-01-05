<!-- Add/Edit Employee Modal -->
<div class="modal fade" id="cutiModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Ajukan Cuti Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cutiForm">
                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">Nomor Induk</label>
                        <select class="form-select" id="nomor_induk" name="nomor_induk" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="lama_cuti" class="form-label">Lama Cuti</label>
                        <input type="number" class="form-control" id="lama_cuti" name="lama_cuti" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_cuti" class="form-label">Tanggal Cuti</label>
                        <input type="date" class="form-control" id="tanggal_cuti" name="tanggal_cuti" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>