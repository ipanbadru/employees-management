<div class="modal fade" id="detail-pegawai" tabindex="-1" role="dialog" aria-labelledby="detail-pegawai" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">Modal Pegawai</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" x-data="{ pathStorage: '{{ asset('storage') }}/', pathRoot: '{{ asset('/') }}', jenisKelamin: { L: 'Laki-Laki', P: 'Perempuan' } }">
                    <div class="col-4">
                        <img :src="dataDetail.foto ? pathStorage + dataDetail.foto : pathRoot + 'assets/images/profile.jpg'"
                            class="w-100" alt="">
                    </div>
                    <div class="col-7">
                        <p>Nama : <span x-text="dataDetail.nama"></span></p>
                        <p>Jenis Kelamin : <span x-text="jenisKelamin[dataDetail.jenis_kelamin]"></span></p>
                        <p>Tanggal Lahir : <span x-text="dataDetail.tanggal_lahir_formated"></span></p>
                    </div>
                    <div class="col-12 mt-3">
                        <p>No Telepon : <span x-text="dataDetail.no_telepon"></span></p>
                        <p>Email : <span x-text="dataDetail.email"></span></p>
                        <p>Alamat : <span x-text="dataDetail.alamat"></span></p>
                    </div>
                    <div class="col-12">
                        <p>Jabatan : <span x-text="dataDetail.jabatan"></span></p>
                        <p>Tanggal Bergabung : <span x-text="dataDetail.tanggal_bergabung_formated"></span></p>
                        <p>Gaji : <span x-text="dataDetail.gaji_formated"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gray-200" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
