<div class="modal fade" id="modal-pegawai" tabindex="-1" role="dialog" aria-labelledby="modal-pegawai" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <form action="" @submit.prevent="submit" class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Modal Pegawai</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama">Nama <span class="text-xs text-danger">*</span></label>
                        <input type="text" x-model="fields.nama" x-bind:class="errors.nama ? 'is-invalid' : ''"
                            class="form-control" id="nama">
                        <div class="invalid-feedback">
                            <span x-text="errors.nama ? errors.nama[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-xs text-danger">*</span></label>
                        <select x-model="fields.jenis_kelamin" x-bind:class="errors.jenis_kelamin ? 'is-invalid' : ''"
                            class="form-select" id="jenis_kelamin">
                            <option value="" hidden></option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <span x-text="errors.jenis_kelamin ? errors.jenis_kelamin[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-xs text-danger">*</span></label>
                        <input type="date" x-model="fields.tanggal_lahir"
                            x-bind:class="errors.tanggal_lahir ? 'is-invalid' : ''" class="form-control"
                            id="tanggal_lahir">
                        <div class="invalid-feedback">
                            <span x-text="errors.tanggal_lahir ? errors.tanggal_lahir[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_telepon">No Telepon <span class="text-xs text-danger">*</span></label>
                        <input type="number" x-model="fields.no_telepon"
                            x-bind:class="errors.no_telepon ? 'is-invalid' : ''" class="form-control" id="no_telepon"
                            placeholder="08xxxxxx">
                        <div class="invalid-feedback">
                            <span x-text="errors.no_telepon ? errors.no_telepon[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-xs text-danger">*</span></label>
                        <input type="email" x-model="fields.email" x-bind:class="errors.email ? 'is-invalid' : ''"
                            class="form-control" id="email">
                        <div class="invalid-feedback">
                            <span x-text="errors.email ? errors.email[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat">Alamat <span class="text-xs text-danger">*</span></label>
                        <input type="text" x-model="fields.alamat" x-bind:class="errors.alamat ? 'is-invalid' : ''"
                            class="form-control" id="alamat">
                        <div class="invalid-feedback">
                            <span x-text="errors.alamat ? errors.alamat[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_bergabung">Tanggal Bergabung <span
                                class="text-xs text-danger">*</span></label>
                        <input type="date" x-model="fields.tanggal_bergabung"
                            x-bind:class="errors.tanggal_bergabung ? 'is-invalid' : ''" class="form-control"
                            id="tanggal_bergabung">
                        <div class="invalid-feedback">
                            <span x-text="errors.tanggal_bergabung ? errors.tanggal_bergabung[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jabatan">Jabatan <span class="text-xs text-danger">*</span></label>
                        <input type="text" x-model="fields.jabatan" x-bind:class="errors.jabatan ? 'is-invalid' : ''"
                            class="form-control" id="jabatan">
                        <div class="invalid-feedback">
                            <span x-text="errors.jabatan ? errors.jabatan[0] : ''"></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gaji">Gaji <span class="text-xs text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">RP</span>
                            <input type="text" x-model="fields.gaji" x-bind:class="errors.gaji ? 'is-invalid' : ''"
                                class="form-control rounded-end" id="gaji">
                            <div class="invalid-feedback">
                                <span x-text="errors.gaji ? errors.gaji[0] : ''"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Foto</label>
                        <label for="foto" class="input-group" style="cursor: pointer">
                            <span class="input-group-text">Choose File</span>
                            <span class="form-control rounded-end" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap" x-text="fields.labelFoto ? fields.labelFoto : 'No file chosen'"></span>
                            <input type="file" class="d-none"
                                id="foto" @change="fields.foto = $event.target.files[0], fields.labelFoto = $event.target.files[0].name" accept="image/*">
                                <div class="invalid-feedback">
                                    <span x-text="errors.foto ? errors.foto[0] : ''"></span>
                                </div>
                        </label>
                    </div>
                    <div class="col-md-12"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary d-inline-flex align-items-center"
                    x-bind:disabled="loading">
                    <div class="spinner-border text-light spinner-border-sm me-2" x-show="loading" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <i class="fa-solid fa-floppy-disk me-2"></i>Simpan
                </button>
                <button type="button" class="btn btn-gray-200" data-bs-dismiss="modal">Kembali</button>
            </div>
        </form>
    </div>
</div>
