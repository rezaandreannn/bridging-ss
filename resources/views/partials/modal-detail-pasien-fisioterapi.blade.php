<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>NO RM dan Nama</th>
            <th>Kode Reg</th>
            <th>Dokter</th>
            <th>Layanan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fisioterapiDetail as $pasien)
        @php
        $tanggal = date('d-m-Y', strtotime($pasien->Tanggal));
        @endphp
        <tr>
            <td>{{ $tanggal }}</td>
            <td><span style="color: red">({{ $pasien->No_MR }})</span> - {{ $pasien->Nama_Pasien }}</td>
            <td>{{ $pasien->No_Reg }}</td>
            <td>{{ $pasien->Nama_Dokter }}</td>
            <td>{{ $pasien->Medis }}</td>
            <td width="20%">
   
                <a href="{{ route('berkas.cppt', ['no_mr' => $pasien->No_MR,'no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Cppt</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>