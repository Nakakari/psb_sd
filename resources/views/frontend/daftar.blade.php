 @extends('layouts.main')
 @if ($status == 1)

     @section('css')
         <style type="text/css">
             * {
                 box-sizing: border-box;
             }

             body {
                 background-color: #f1f1f1;
             }

             .container2 {
                 width: 100%;

             }

             #regForm {
                 background-color: #ffffff;
                 margin: 100px auto;
                 font-family: Raleway;
                 padding: 40px;
                 width: 70%;
                 min-width: 300px;
             }

             h1 {
                 text-align: center;
             }

             input {
                 padding: 10px;
                 width: 100%;
                 font-size: 17px;
                 font-family: Raleway;
                 border: 1px solid #aaaaaa;
             }

             /* Mark input boxes that gets an error on validation: */
             input.invalid {
                 background-color: #ffdddd;
             }

             /* Hide all steps by default: */
             .tab {
                 display: none;
             }

             button {
                 background-color: #e47411;
                 color: #ffffff;
                 border: none;
                 padding: 10px 20px;
                 font-size: 17px;
                 font-family: Raleway;
                 cursor: pointer;
             }

             button:hover {
                 opacity: 0.8;
             }

             #prevBtn {
                 background-color: #bbbbbb;
             }

             /* Make circles that indicate the steps of the form: */
             .step {
                 height: 15px;
                 width: 15px;
                 margin: 0 2px;
                 background-color: #bbbbbb;
                 border: none;
                 border-radius: 50%;
                 display: inline-block;
                 opacity: 0.5;
             }

             .step.active {
                 opacity: 1;
             }

             /* Mark the steps that are finished and valid: */
             .step.finish {
                 background-color: #e47411;
             }

             .alert {
                 padding: 20px;
                 background-color: #f44336;
                 color: white;
             }

             .successs {
                 padding: 20px;
                 background-color: #45e534;
                 color: white;
             }

             .closebtn {
                 margin-left: 15px;
                 color: white;
                 font-weight: bold;
                 float: right;
                 font-size: 22px;
                 line-height: 20px;
                 cursor: pointer;
                 transition: 0.3s;
             }

             .closebtn:hover {
                 color: black;
             }
         </style>
     @stop
     @section('container')

         <div class="container">
             @if (session('pesan'))
                 <div class="successs">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <strong>Success - </strong> {{ session('pesan') }}!
                 </div>
             @elseif (session('hapus'))
                 <div class="alert">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <strong>{{ session('hapus') }}</strong>.
                 </div>
             @elseif(count($errors) > 0)
                 <div class="alert">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <strong>
                         Perhatikan Isian Data Anda secara Detail!
                     </strong>
                 </div>
             @endif
             {{-- <div class="content"> --}}
             <form id="regForm" enctype="multipart/form-data" action="/add_siswa" method="POST">
                 {{ csrf_field() }}
                 <h1>Pendaftaran Calon Siswa Baru</h1>
                 <!-- One "tab" for each step in the form: -->
                 <div class="tab">
                     <span class="title">Data Diri Siswa Baru</span>

                     <div class="fields">
                         <div class="input-field">
                             <label>Nama Lengkap</label>
                             <input type="text" placeholder="Nama Lengkap" name="nama_lengkap"
                                 value="{{ old('nama_lengkap') }}" required>
                             @if ($errors->has('nama_lengkap'))
                                 <span class="text-danger">{{ $errors->first('nama_lengkap') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tanggal Lahir</label>
                             <input type="date" placeholder="Tanggal Lahir" name="tanggal_lahir"
                                 value="{{ old('tanggal_lahir') }}" required>
                             @if ($errors->has('tanggal_lahir'))
                                 <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tempat Lahir</label>
                             <input type="text" placeholder="Tempat Lahir" name="tempat_lahir"
                                 value="{{ old('tempat_lahir') }}" required>
                             @if ($errors->has('tempat_lahir'))
                                 <span class="text-danger">{{ $errors->first('tempat_lahir') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Agama</label>
                             <input type="text" placeholder="Agama" name="agama" value="{{ old('agama') }}" required>
                             @if ($errors->has('agama'))
                                 <span class="text-danger">{{ $errors->first('agama') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Kewarganegaraan</label>
                             <select class="form-control form-select" aria-label="Default select example"
                                 name="kewarganegaraan" id="kewarganegaraan" required>
                                 <option disabled selected>Pilih Kwarganegaraan</option>
                                 <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI
                                 </option>
                                 <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA
                                 </option>
                             </select>
                             @if ($errors->has('kewarganegaraan'))
                                 <span class="text-danger">{{ $errors->first('kewarganegaraan') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Jenis Kelamin</label>
                             <select class="form-control form-select" aria-label="Default select example" name="jk"
                                 id="jk" required>
                                 <option disabled selected>Pilih Jenis Kelamin</option>
                                 @foreach ($jk as $j)
                                     <option value="{{ $j->id }}" {{ old('jk') == $j->id ? 'selected' : '' }}>
                                         {{ $j->jenis_kelamin }}</option>
                                 @endforeach
                             </select>
                             @if ($errors->has('jk'))
                                 <span class="text-danger">{{ $errors->first('jk') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Nomor Induk Kependudukan</label>
                             <input type="number" placeholder="Nomor Induk Kependudukan" name="nik"
                                 value="{{ old('nik') }}" required>
                             @if ($errors->has('nik'))
                                 <span class="text-danger">{{ $errors->first('nik') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Anak Ke-</label>
                             <input type="text" placeholder="Anak Ke-" name="anak_ke" value="{{ old('anak_ke') }}"
                                 required>
                             @if ($errors->has('anak_ke'))
                                 <span class="text-danger">{{ $errors->first('anak_ke') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Bahasa Sehari-Hari</label>
                             <input type="text" placeholder="Bahasa Sehari-Hari" name="bahasa_sehari"
                                 value="{{ old('bahasa_sehari') }}" required>
                             @if ($errors->has('bahasa_sehari'))
                                 <span class="text-danger">{{ $errors->first('bahasa_sehari') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Foto</label>
                             <input type="file" placeholder="Foto" name="foto" value="{{ old('foto') }}" required>
                             @if ($errors->has('foto'))
                                 <span class="text-danger">{{ $errors->first('foto') }}</span>
                             @endif
                         </div>

                     </div>
                 </div>
                 <div class="tab">
                     <span class="title">Alamat Siswa</span>

                     <div class="fields">
                         <div class="input-field">
                             <label>Alamat Tempat Tinggal</label>
                             <textarea class="form-control" name="alamat_tempat_tinggal" id="alamat_tempat_tinggal"
                                 placeholder="Alamat Tempat Tinggal..." rows="3" required>{{ old('alamat_tempat_tinggal') }}</textarea>
                             @if ($errors->has('alamat_tempat_tinggal'))
                                 <span class="text-danger">{{ $errors->first('alamat_tempat_tinggal') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>RT</label>
                             <input type="number" placeholder="RT" name="rt" value="{{ old('rt') }}" required>
                             @if ($errors->has('rt'))
                                 <span class="text-danger">{{ $errors->first('rt') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>RW</label>
                             <input type="text" placeholder="RW" name="rw" value="{{ old('rw') }}" required>
                             @if ($errors->has('rw'))
                                 <span class="text-danger">{{ $errors->first('rw') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Dusun</label>
                             <input type="text" placeholder="Dusun Opsional" name="dusun"
                                 value="{{ old('dusun') }}" required>
                         </div>

                         <div class="input-field">
                             <label>Desa/Kelurahan</label>
                             <input type="text" placeholder="Desa/Kelurahan" name="desa"
                                 value="{{ old('desa') }}" required>
                             @if ($errors->has('desa'))
                                 <span class="text-danger">{{ $errors->first('desa') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Kecamatan</label>
                             <input type="text" placeholder="Kecamatan" name="kecamatan"
                                 value="{{ old('kecamatan') }}" required>
                             @if ($errors->has('kecamatan'))
                                 <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Kabupaten</label>
                             <input type="text" placeholder="Kabupaten" name="kab" value="{{ old('kab') }}"
                                 required>
                             @if ($errors->has('kab'))
                                 <span class="text-danger">{{ $errors->first('kab') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Provinsi</label>
                             <input type="Text" placeholder="Provinsi" name="prov" value="{{ old('prov') }}"
                                 required>
                             @if ($errors->has('prov'))
                                 <span class="text-danger">{{ $errors->first('prov') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Kode Pos</label>
                             <input type="Text" placeholder="Kode Pos" name="kode_pos" value="{{ old('kode_pos') }}"
                                 required>
                             @if ($errors->has('kode_pos'))
                                 <span class="text-danger">{{ $errors->first('kode_pos') }}</span>
                             @endif
                         </div>
                     </div>

                 </div>
                 <div class="tab">
                     <span class="title">Data Ayah Kandung</span>

                     <div class="fields">
                         <div class="input-field">
                             <label>Nama Ayah Kandung</label>
                             <input type="text" placeholder="Permanent or Temporary" name="nama_ayah"
                                 value="{{ old('nama_ayah') }}" required>
                             @if ($errors->has('nama_ayah'))
                                 <span class="text-danger">{{ $errors->first('nama_ayah') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tempat Lahir Ayah Kandung</label>
                             <input type="text" placeholder="Enter nationality" name="tempat_lahir_ayah"
                                 value="{{ old('tempat_lahir_ayah') }}" required>
                             @if ($errors->has('tempat_lahir_ayah'))
                                 <span class="text-danger">{{ $errors->first('tempat_lahir_ayah') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tanggal Lahir Ayah Kandung</label>
                             <input type="date" placeholder="Enter your state" name="tanggal_lahir_ayah"
                                 value="{{ old('tanggal_lahir_ayah') }}" required>
                             @if ($errors->has('tanggal_lahir_ayah'))
                                 <span class="text-danger">{{ $errors->first('tanggal_lahir_ayah') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Pendidikan Ayah Kandung</label>
                             <select class="form-control form-select" aria-label="Default select example"
                                 name="id_pendidikan_ayah" id="id_pendidikan_ayah" required>
                                 <option disabled selected>Pilih Pendidikan Terakhir</option>
                                 @foreach ($pendidikan as $p)
                                     <option value="{{ $p->id }}"
                                         {{ old('id_pendidikan_ayah') == $p->id ? 'selected' : '' }}>
                                         {{ $p->nama_pendidikan }}</option>
                                 @endforeach
                             </select>
                             @if ($errors->has('id_pendidikan_ayah'))
                                 <span class="text-danger">{{ $errors->first('id_pendidikan_ayah') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Perkejaan Ayah Kandung</label>
                             <input type="text" placeholder="Perkejaan Ayah Kandung" name="pekerjaan_ayah"
                                 value="{{ old('pekerjaan_ayah') }}" required>
                             @if ($errors->has('pekerjaan_ayah'))
                                 <span class="text-danger">{{ $errors->first('pekerjaan_ayah') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Nomor Telepon Ayah</label>
                             <input type="text" placeholder="Nomor Telepon Ayah" name="no_telp_ayah"
                                 value="{{ old('no_telp_ayah') }}" required>
                             @if ($errors->has('no_telp_ayah'))
                                 <span class="text-danger">{{ $errors->first('no_telp_ayah') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Nama Instansi Ayah Berkerja</label>
                             <input type="text" placeholder="Nama Instansi Ayah Berkerja" name="instansi_ayah"
                                 value="{{ old('instansi_ayah') }}" required>
                             @if ($errors->has('instansi_ayah'))
                                 <span class="text-danger">{{ $errors->first('instansi_ayah') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Alamat Pekerjaan Ayah</label>
                             <input type="text" placeholder="Alamat Pekerjaan Ayah" name="alamat_kerja_ayah"
                                 value="{{ old('alamat_kerja_ayah') }}" required>
                             @if ($errors->has('alamat_kerja_ayah'))
                                 <span class="text-danger">{{ $errors->first('alamat_kerja_ayah') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Penghasilan Ayah Per Bulan</label>
                             <input type="number" placeholder="Penghasilan Ayah Per Bulan" name="penghasilan_ayah"
                                 value="{{ old('penghasilan_ayah') }}" required>
                             @if ($errors->has('penghasilan_ayah'))
                                 <span class="text-danger">{{ $errors->first('penghasilan_ayah') }}</span>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="tab">
                     <span class="title">Data Ibu Kandung</span>

                     <div class="fields">
                         <div class="input-field">
                             <label>Nama ibu Kandung</label>
                             <input type="text" placeholder="Permanent or Temporary" name="nama_ibu"
                                 value="{{ old('nama_ibu') }}" required>
                             @if ($errors->has('nama_ibu'))
                                 <span class="text-danger">{{ $errors->first('nama_ibu') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tempat Lahir ibu Kandung</label>
                             <input type="text" placeholder="Tempat Lahir Ibu Kandung" name="tempat_lahir_ibu"
                                 value="{{ old('tempat_lahir_ibu') }}" required>
                             @if ($errors->has('tempat_lahir_ibu'))
                                 <span class="text-danger">{{ $errors->first('tempat_lahir_ibu') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tanggal Lahir ibu Kandung</label>
                             <input type="date" placeholder="Tanggal Lahir Ibu" name="tanggal_lahir_ibu"
                                 value="{{ old('tanggal_lahir_ibu') }}" required>
                             @if ($errors->has('tanggal_lahir_ibu'))
                                 <span class="text-danger">{{ $errors->first('tanggal_lahir_ibu') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Pendidikan ibu Kandung</label>
                             <select class="form-control form-select" aria-label="Default select example"
                                 name="id_pendidikan_ibu" id="id_pendidikan_ibu" required>
                                 <option disabled selected>Pilih Pendidikan Terakhir</option>
                                 @foreach ($pendidikan as $p)
                                     <option value="{{ $p->id }}"
                                         {{ old('id_pendidikan_ibu') == $p->id ? 'selected' : '' }}>
                                         {{ $p->nama_pendidikan }}
                                     </option>
                                 @endforeach
                             </select>
                             @if ($errors->has('id_pendidikan_ibu'))
                                 <span class="text-danger">{{ $errors->first('id_pendidikan_ibu') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Perkejaan ibu Kandung</label>
                             <input type="text" placeholder="Perkejaan ibu Kandung" name="pekerjaan_ibu"
                                 value="{{ old('pekerjaan_ibu') }}" required>
                             @if ($errors->has('pekerjaan_ibu'))
                                 <span class="text-danger">{{ $errors->first('pekerjaan_ibu') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Nomor Telepon ibu</label>
                             <input type="text" placeholder="Nomor Telepon ibu" name="no_tlp_ibu"
                                 value="{{ old('no_tlp_ibu') }}" required>
                             @if ($errors->has('no_tlp_ibu'))
                                 <span class="text-danger">{{ $errors->first('no_tlp_ibu') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Nama Instansi ibu Berkerja</label>
                             <input type="text" placeholder="Nama Instansi ibu Berkerja" name="instansi_kerja_ibu"
                                 value="{{ old('instansi_kerja_ibu') }}" required>
                             @if ($errors->has('instansi_kerja_ibu'))
                                 <span class="text-danger">{{ $errors->first('instansi_kerja_ibu') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Alamat Pekerjaan ibu</label>
                             <input type="text" placeholder="Alamat Pekerjaan ibu" name="alamat_kerja_ibu"
                                 value="{{ old('alamat_kerja_ibu') }}" required>
                             @if ($errors->has('alamat_kerja_ibu'))
                                 <span class="text-danger">{{ $errors->first('alamat_kerja_ibu') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Penghasilan ibu Per Bulan</label>
                             <input type="number" placeholder="Penghasilan ibu Per Bulan" name="penghasilan_ibu"
                                 value="{{ old('penghasilan_ibu') }}" required>
                             @if ($errors->has('penghasilan_ibu'))
                                 <span class="text-danger">{{ $errors->first('penghasilan_ibu') }}</span>
                             @endif
                         </div>

                     </div>
                 </div>
                 <div class="tab">
                     <span class="title">Data Wali Murid</span>

                     <div class="fields">
                         <div class="input-field">
                             <label>Nama Wali Murid</label>
                             <input type="text" placeholder="Nama Wali Murid" name="nama_wali_murid"
                                 value="{{ old('nama_wali_murid') }}">
                         </div>

                         <div class="input-field">
                             <label>Tempat Lahir Wali Murid</label>
                             <input type="text" placeholder="Tempat Lahir Wali" name="tempat_lahir_wali"
                                 value="{{ old('tempat_lahir_wali') }}">
                         </div>

                         <div class="input-field">
                             <label>Tanggal Lahir Wali Murid</label>
                             <input type="date" placeholder="Tanggal Lahir Wali Murid" name="tgl_lahir_wali"
                                 value="{{ old('tgl_lahir_wali') }}">
                         </div>

                         <div class="input-field">
                             <label>Pendidikan Wali Murid</label>
                             <select class="form-control form-select" aria-label="Default select example"
                                 name="id_pendidikan_wali" id="id_pendidikan_wali">
                                 <option disabled selected>Pilih Pendidikan Terakhir</option>
                                 @foreach ($pendidikan as $p)
                                     <option value="{{ $p->id }}"
                                         {{ old('id_pendidikan_wali') == $p->id ? 'selected' : '' }}>
                                         {{ $p->nama_pendidikan }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <div class="input-field">
                             <label>Perkejaan Wali Murid</label>
                             <input type="text" placeholder="Perkejaan Wali Murid" name="pekerjaan_wali"
                                 value="{{ old('pekerjaan_wali') }}">
                         </div>

                         <div class="input-field">
                             <label>Nomor Telepon Wali</label>
                             <input type="text" placeholder="Nomor Telepon wali" name="no_tlp_wali"
                                 value="{{ old('no_tlp_wali') }}">
                         </div>
                         <div class="input-field">
                             <label>Nama Instansi wali Berkerja</label>
                             <input type="text" placeholder="Nama Instansi wali Berkerja" name="instansi_kerja_wali"
                                 value="{{ old('instansi_kerja_wali') }}">
                         </div>
                         <div class="input-field">
                             <label>Alamat Pekerjaan wali</label>
                             <input type="text" placeholder="Alamat Pekerjaan wali" name="alamat_kerja_wali"
                                 value="{{ old('alamat_kerja_wali') }}">
                         </div>
                         <div class="input-field">
                             <label>Penghasilan wali Per Bulan</label>
                             <input type="number" placeholder="Penghasilan wali Per Bulan" name="penghasilan_wali"
                                 value="{{ old('penghasilan_wali') }}">
                         </div>

                     </div>
                 </div>
                 <div class="tab">
                     <span class="title">Kontak Orang Tua / Wali Murid</span>

                     <div class="fields">
                         <div class="input-field">
                             <label>Nomor WhatsApp</label>
                             <input type="number" placeholder="Nomor WA Orangtua" name="no_wa"
                                 value="{{ old('no_wa') }}" required>
                             @if ($errors->has('no_wa'))
                                 <span class="text-danger">{{ $errors->first('no_wa') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Email Orang Tua / Wali</label>
                             <input type="email" placeholder="Email Orang Tua" name="email_ortu"
                                 value="{{ old('email_ortu') }}" required>
                             @if ($errors->has('email_ortu'))
                                 <span class="text-danger">{{ $errors->first('email_ortu') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Jarak Rumah Ke Sekolah</label>
                             <input type="text" placeholder="Jarak ke Sekolah" name="jarak"
                                 value="{{ old('jarak') }}" required>
                             @if ($errors->has('jarak'))
                                 <span class="text-danger">{{ $errors->first('jarak') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Transpotasi Ke Sekolah</label>
                             <select class="form-control form-select" aria-label="Default select example"
                                 name="id_jenis_transport" id="id_jenis_transport" required>
                                 <option disabled selected>Pilih Jenis Transportasi</option>
                                 @foreach ($trans as $t)
                                     <option value="{{ $t->id_jenis_transportasi }}"
                                         {{ old('id_jenis_transport') == $t->id_jenis_transportasi ? 'selected' : '' }}>
                                         {{ $t->nama_transportasi }}</option>
                                 @endforeach
                             </select>
                             @if ($errors->has('id_jenis_transport'))
                                 <span class="text-danger">{{ $errors->first('id_jenis_transport') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Hobi Kegemaran Anak</label>
                             <input type="text" placeholder="Permanent or Temporary" name="hobi_anak"
                                 value="{{ old('hobi_anak') }}" required>
                             @if ($errors->has('hobi_anak'))
                                 <span class="text-danger">{{ $errors->first('hobi_anak') }}</span>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="tab">
                     <span class="title">Informasi Peserta Didik Baru</span>
                     <div class="fields">
                         <div class="input-field">
                             <label>Perserta Didik tinggal Bersama</label>
                             <input type="text" placeholder="Perserta Didik tinggal Bersama" name="ket_tinggal"
                                 value="{{ old('ket_tinggal') }}" required>
                             @if ($errors->has('ket_tinggal'))
                                 <span class="text-danger">{{ $errors->first('ket_tinggal') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Anak Ke</label>
                             <input type="number" placeholder="Anak Ke-" name="anak_ke_inf"
                                 value="{{ old('anak_ke_inf') }}" required>
                             @if ($errors->has('anak_ke_inf'))
                                 <span class="text-danger">{{ $errors->first('anak_ke_inf') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Saudara Kandung</label>
                             <input type="number" placeholder="Jumlah Saudara Kandung" name="jml_saudara"
                                 value="{{ old('jml_saudara') }}" required>
                             @if ($errors->has('jml_saudara'))
                                 <span class="text-danger">{{ $errors->first('jml_saudara') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Berapa Saudara</label>
                             <input type="number" placeholder="Dari Berapa Saudara" name="brp_saudara"
                                 value="{{ old('brp_saudara') }}" required>
                             @if ($errors->has('brp_saudara'))
                                 <span class="text-danger">{{ $errors->first('brp_saudara') }}</span>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="tab">
                     <span class="title">Jasmani Peserta Didik Baru</span>
                     <div class="fields">
                         <div class="input-field">
                             <label>Golongan Darah</label>
                             <select class="form-control form-select" aria-label="Default select example"
                                 name="id_goldar" id="id_goldar" required>
                                 <option disabled selected>Pilih Golongan Darah</option>
                                 @foreach ($goldar as $g)
                                     <option value="{{ $g->id_goldar }}"
                                         {{ old('id_goldar') == $g->id_goldar ? 'selected' : '' }}>
                                         {{ $g->goldar }}</option>
                                 @endforeach
                             </select>
                             @if ($errors->has('id_goldar'))
                                 <span class="text-danger">{{ $errors->first('id_goldar') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Berat Badan</label>
                             <input type="number" placeholder="Berat Badan" name="bb"
                                 value="{{ old('bb') }}" required>
                             @if ($errors->has('bb'))
                                 <span class="text-danger">{{ $errors->first('bb') }}</span>
                             @endif
                         </div>

                         <div class="input-field">
                             <label>Tinggi Badan</label>
                             <input type="number" placeholder="Tinggi Badan" name="tb"
                                 value="{{ old('tb') }}" required>
                             @if ($errors->has('tb'))
                                 <span class="text-danger">{{ $errors->first('tb') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Riwayat Penyakit</label>
                             <input type="text" placeholder="Isikan Tidak Ada jika tidak memiliki"
                                 name="riwayat_penyakit" value="{{ old('riwayat_penyakit') }}" required>
                             @if ($errors->has('riwayat_penyakit'))
                                 <span class="text-danger">{{ $errors->first('riwayat_penyakit') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Kelainan Jasmani</label>
                             <input type="text" placeholder="Isikan Tidak Ada jika tidak memiliki"
                                 name="kelainan_jasmani" value="{{ old('kelainan_jasmani') }}" required>
                             @if ($errors->has('kelainan_jasmani'))
                                 <span class="text-danger">{{ $errors->first('kelainan_jasmani') }}</span>
                             @endif
                         </div>
                         <div class="input-field">
                             <label>Alergi</label>
                             <input type="text" placeholder="Isikan Tidak Ada jika tidak memiliki" name="alergi"
                                 value="{{ old('alergi') }}" required>
                             @if ($errors->has('alergi'))
                                 <span class="text-danger">{{ $errors->first('alergi') }}</span>
                             @endif
                         </div>
                     </div>
                 </div>


                 <div style="overflow:auto;">
                     <div style="float:right;">
                         <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                         <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                     </div>
                 </div>
                 <!-- Circles which indicates the steps of the form: -->
                 <div style="text-align:center;margin-top:40px;">
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                     <span class="step"></span>
                 </div>
             </form>
         </div>


     @stop
     @section('js')
         <script type="text/javascript">
             var currentTab = 0; // Current tab is set to be the first tab (0)
             showTab(currentTab); // Display the current tab

             function showTab(n) {
                 // This function will display the specified tab of the form...
                 var x = document.getElementsByClassName("tab");
                 x[n].style.display = "block";
                 //... and fix the Previous/Next buttons:
                 if (n == 0) {
                     document.getElementById("prevBtn").style.display = "none";
                 } else {
                     document.getElementById("prevBtn").style.display = "inline";
                 }
                 if (n == (x.length - 1)) {
                     document.getElementById("nextBtn").innerHTML = "Submit";
                 } else {
                     document.getElementById("nextBtn").innerHTML = "Next";
                 }
                 //... and run a function that will display the correct step indicator:
                 fixStepIndicator(n)
             }

             function nextPrev(n) {
                 // This function will figure out which tab to display
                 var x = document.getElementsByClassName("tab");
                 // Exit the function if any field in the current tab is invalid:
                 // if (n == 1 && !validateForm()) return false;
                 // Hide the current tab:
                 x[currentTab].style.display = "none";
                 // Increase or decrease the current tab by 1:
                 currentTab = currentTab + n;
                 // if you have reached the end of the form...
                 if (currentTab >= x.length) {
                     // ... the form gets submitted:
                     document.getElementById("regForm").submit();
                     return false;
                 }
                 // Otherwise, display the correct tab:
                 showTab(currentTab);
             }

             function validateForm() {
                 // This function deals with validation of the form fields
                 var x, y, i, valid = true;
                 x = document.getElementsByClassName("tab");
                 y = x[currentTab].getElementsByTagName("input");
                 // A loop that checks every input field in the current tab:
                 for (i = 0; i < y.length; i++) {
                     // If a field is empty...
                     if (y[i].value == "") {
                         // add an "invalid" class to the field:
                         y[i].className += " invalid";
                         // and set the current valid status to false
                         valid = false;
                     }
                 }
                 // If the valid status is true, mark the step as finished and valid:
                 if (valid) {
                     document.getElementsByClassName("step")[currentTab].className += " finish";
                 }
                 return valid; // return the valid status
             }

             function fixStepIndicator(n) {
                 // This function removes the "active" class of all steps...
                 var i, x = document.getElementsByClassName("step");
                 for (i = 0; i < x.length; i++) {
                     x[i].className = x[i].className.replace(" active", "");
                 }
                 //... and adds the "active" class on the current step:
                 x[n].className += " active";
             }
         </script>
     @stop
 @else
     @section('container')
         @vite(['public/scss/style.scss']);
         <div class="tbl-ppdb">
             <div class="container-tbl">
                 <h1>{{ $nama }}</h1>
                 <p>{{ $ket }}</p>
             </div>
         </div>
     @stop
 @endif
