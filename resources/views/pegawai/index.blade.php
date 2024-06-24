<x-layout title="Pegawai">
    <div x-data="pegawai">
        <div class="d-flex justify-content-between flex-nowrap mt-3">
            <h1 class="h4">Data Pegawai</h1>
            <button type="button" class="btn btn-secondary d-inline-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#modal-pegawai">
                <i class="fa-solid fa-plus me-2"></i>
                Tambah Pegawai
            </button>
        </div>

        <div class="card border-0 shadow my-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <label for="show" class="me-2">Show</label>
                        <select name="show" id="show" x-model="show" class="form-select" style="width: 70px">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div>
                        <input type="text" name="q" id="q" x-model="q" placeholder="Search....."
                            class="form-control">
                    </div>
                </div>
                <div class="table-responsive table-bordered">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th class="border-0 rounded-start">No</th>
                                <th class="border-0">Foto</th>
                                <th class="border-0">Nama Pegawai</th>
                                <th class="border-0">No Telepon</th>
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
                            <template x-if="!loadingFetch && listPegawai.length == 0">
                                <tr>
                                    <td colspan="7" class="text-center">Data Tidak tersedia</td>
                                </tr>
                            </template>
                            <template
                                x-for="(item, i) in listPegawai.slice(currentPage * show - show, currentPage * show)"
                                x-data="{ pathStorage: '{{ asset('storage') }}/', pathRoot: '{{ asset('/') }}', jenisKelamin: { L: 'Laki-Laki', P: 'Perempuan' } }">
                                <tr>
                                    <td class="border-0" x-text="(currentPage * show - show) + i + 1"></td>
                                    <td class="border-0"><img
                                            :src="item.foto ? pathStorage + item.foto : pathRoot + 'assets/images/profile.jpg'"
                                            alt="" width="70"></td>
                                    <td class="border-0" x-text="item.nama"></td>
                                    <td class="border-0" x-text="item.no_telepon"></td>
                                    <td class="border-0" x-text="jenisKelamin[item.jenis_kelamin]"></td>
                                    <td class="border-0">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            @click="dataDetail = item" data-bs-toggle="modal"
                                            data-bs-target="#detail-pegawai"><i class="fa-solid fa-circle-info"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-outline-primary"
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
                    <div class="d-flex justify-content-end mt-3">
                        <ul class="pagination">
                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }"><button
                                    :disabled="currentPage === 1" class="page-link"
                                    :class="{ 'bg-gray-200': currentPage === 1 }"
                                    @click="changePage(currentPage - 1)">Previous</button></li>
                            <template x-if="pagination.pages.length === 0">
                                <li class="page-item active"><button class="page-link">1</button></li>
                            </template>
                            <template x-for="item in pagination.pages">
                                <li class="page-item" :class="item === currentPage ? 'active' : ''"><button :disabled="item === currentPage || item === '...'"
                                        @click="changePage(item)" class="page-link" x-text="item"></button></li>
                            </template>
                            <li class="page-item" :class="{ 'disabled': currentPage == pagination.lastPage }"><button
                                    :disabled="currentPage == pagination.lastPage" class="page-link"
                                    :class="{ 'bg-gray-200': currentPage == pagination.lastPage }"
                                    @click="changePage(currentPage + 1)">Next</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('pegawai._form')

        @include('pegawai._detail')

    </div>

    @push('js')
        <script>
            const modalPegawai = document.querySelector('#modal-pegawai');
            document.addEventListener('alpine:init', () => {
                Alpine.data('pegawai', () => ({
                    loadingFetch: false,
                    pegawai: [],
                    listPegawai: [],
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
                    dataDetail: {},
                    q: '',
                    show: 10,
                    currentPage: 1,
                    pagination: {
                        pages: [],
                    },

                    init() {
                        this.$watch('q', (value) => {
                            this.search(value)
                            this.getPages();
                        });
                        this.$watch('pegawai', () => this.search(this.q));
                        this.$watch('show', () => this.getPages());
                        this.$watch('listPegawai', () => this.getPages());
                        this.$watch('currentPage', () => this.getPages());
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

                    search(q) {
                        if (q.length > 1) {
                            const fuse = new Fuse(this.pegawai, {
                                keys: ['nama', 'no_telepon'],
                                threshold: 0.3
                            });

                            this.listPegawai = fuse.search(q).map(result => result.item);
                        } else {
                            this.listPegawai = this.pegawai
                        }
                    },

                    getPages() {
                        if(this.listPegawai.length === 0) {
                            this.pagination.pages = [];
                            this.pagination.lastPage = 1;
                            return;
                        }
                        this.pagination.lastPage = Math.ceil(this.listPegawai.length / this.show);
                        this.pagination.pages = [];

                        let from = 1;
                        let to = this.pagination.lastPage;
                        if(this.currentPage - 2 > 1){
                            from = this.currentPage - 2;
                            this.pagination.pages.push('...');
                        }
                        if(this.currentPage + 2 < this.pagination.lastPage){
                            to = this.currentPage + 2;
                        }
                        while(from <= to) {
                            this.pagination.pages.push(from);
                            from++;
                        }
                        if(to !== this.pagination.lastPage) {
                            this.pagination.pages.push('...');
                        }
                        if(this.currentPage > this.pagination.lastPage) {
                            this.changePage(this.pagination.lastPage);
                        }
                    },

                    changePage(page) {
                        this.currentPage = page;
                    },

                    async fetchPegawai() {
                        this.loadingFetch = true;
                        try {
                            const response = await axios.get('{{ route('pegawai.index') }}')
                            this.pegawai = response.data.pegawai;
                            this.search(this.q);
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
                        form.append('gaji', this.fields.gaji ? String(this.fields.gaji).replaceAll('.',
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
