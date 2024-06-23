<x-layout title="Pegawai">
    <div x-data="pegawai">
        <div class="row justify-content-between mt-3">
            <div class="col-sm-6">
                <h1 class="h4">Data Pegawai</h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <button type="button" class="btn btn-secondary d-inline-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#modal-pegawai">
                    <i class="fa-solid fa-plus me-2"></i>
                    Tambah Pegawai
                </button>
            </div>
        </div>

        <div class="card border-0 shadow my-4">
            <div class="card-body">
                <div class="table-responsive table-bordered">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">No</th>
                                <th class="border-0">Foto</th>
                                <th class="border-0">Nama Pegawai</th>
                                <th class="border-0">No Telepon</th>
                                <th class="border-0">Email</th>
                                <th class="border-0">Jenis Kelamin</th>
                                <th class="border-0 rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr x-show="loadingFetch">
                                <td colspan="7" class="text-center">
                                    <div class="spinner-border text-secondary me-2" x-show="loading" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            <template x-for="(item, i) in pegawai" x-data="{ pathStorage: '{{ asset('storage') }}/', pathRoot: '{{ asset('/') }}', jenisKelamin: { L: 'Laki-Laki', P: 'Perempuan' } }">
                                <tr>
                                    <td class="border-0" x-text="i + 1"></td>
                                    <td class="border-0"><img
                                            :src="item.foto ? pathStorage + item.foto : pathRoot + 'assets/images/profile.jpg'"
                                            alt=""></td>
                                    <td class="border-0" x-text="item.nama"></td>
                                    <td class="border-0" x-text="item.no_telepon"></td>
                                    <td class="border-0" x-text="item.email"></td>
                                    <td class="border-0" x-text="jenisKelamin[item.jenis_kelamin]"></td>
                                    <td class="border-0">
                                        <button type="button" class="btn btn-sm btn-outline-primary" value=""
                                            @click="fields = {...item, foto: '', gaji: formatRupiah(String(item.gaji)), labelFoto: item.foto ? item.foto.split('/').pop() : ''}"
                                            data-bs-toggle="modal" data-bs-target="#modal-pegawai"><i
                                                class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            @click="destroy(item.id)"><i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('pegawai._form')
    </div>

    @push('js')
        <script>
            const modalPegawai = document.querySelector('#modal-pegawai');
            document.addEventListener('alpine:init', () => {
                Alpine.data('pegawai', () => ({
                    loadingFetch: false,
                    pegawai: [],
                    fields: {
                        'nama': '',
                        'jenis_kelamin': '',
                        'tanggal_lahir': '',
                        'no_telepon': '',
                        'email': '',
                        'alamat': '',
                        'tanggal_bergabung': '',
                        'jabatan': '',
                        'gaji': '',
                        'foto': '',
                    },
                    loading: false,
                    errors: {},

                    init() {
                        this.fetchPegawai();
                        modalPegawai.addEventListener('hidden.bs.modal', () => {
                            this.fields = {
                                'nama': '',
                                'jenis_kelamin': '',
                                'tanggal_lahir': '',
                                'no_telepon': '',
                                'email': '',
                                'alamat': '',
                                'tanggal_bergabung': '',
                                'jabatan': '',
                                'gaji': '',
                                'foto': '',
                            };
                            this.errors = {};
                        });
                    },

                    async fetchPegawai() {
                        this.loadingFetch = true;
                        try {
                            const response = await axios.get(
                                '{{ route('pegawai.index') }}')
                            this.pegawai = response.data.pegawai;
                        } catch (e) {
                            console.log(e);
                            notyf.error('Error fetching data');
                        }
                        this.loadingFetch = false;
                    },

                    async submit() {
                        this.loading = true;
                        this.errors = {}
                        const form = new FormData();
                        form.append('nama', this.fields.nama);
                        form.append('jenis_kelamin', this.fields.jenis_kelamin);
                        form.append('tanggal_lahir', this.fields.tanggal_lahir);
                        form.append('no_telepon', this.fields.no_telepon);
                        form.append('email', this.fields.email);
                        form.append('alamat', this.fields.alamat);
                        form.append('tanggal_bergabung', this.fields.tanggal_bergabung);
                        form.append('jabatan', this.fields.jabatan);
                        form.append('gaji', this.fields.gaji ? String(this.fields.gaji).replace('.',
                            '') : '');
                        form.append('foto', this.fields.foto);

                        const urlAdd = '{{ route('pegawai.store') }}';
                        const urlUpdate = '{{ route('pegawai.update', '') }}';
                        try {
                            if (this.fields.id) {
                                form.append('_method', 'PUT');
                            }
                            const response = await axios.post(this.fields.id ? urlUpdate + '/' + this
                                .fields.id : urlAdd, form);
                            if (response.status === 201) {
                                if (this.fields.id) {
                                    this.pegawai = this.pegawai.map((item) => {
                                        if (item.id === this.fields.id) {
                                            return response.data.data;
                                        }
                                        return item;
                                    });
                                } else {
                                    this.pegawai.unshift(response.data.data);
                                }
                                bootstrap.Modal.getInstance(modalPegawai).hide();
                                notyf.success(response.data.message);
                            }
                        } catch (error) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors
                            }
                        }
                        this.loading = false;
                    },

                    destroy(id) {
                        const urlDelete = '{{ route('pegawai.destroy', '') }}';
                        Swal.fire({
                            title: "Apakah anda yakin?",
                            text: "Data yang dihapus tidak dapat dikembalikan!",
                            showCancelButton: true,
                            confirmButtonText: "Hapus",
                            denyButtonText: "Batal",
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                try {
                                    const response = await axios.delete(urlDelete + '/' + id);
                                    if (response.status === 200) {
                                        this.pegawai = this.pegawai.filter((item) => item.id !==
                                            id);
                                        notyf.success(response.data.message);
                                    }
                                } catch (error) {
                                    notyf.error(error.response.data.message);
                                }
                            }
                        });
                    }
                }));

                const gaji = document.querySelector('#gaji');
                gaji.addEventListener('keyup', function(e) {
                    gaji.value = formatRupiah(this.value);
                });
            })
        </script>
    @endpush
</x-layout>
