<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Peringatan</title>
    <style>
        * {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            box-sizing: border-box;
        }

        .border-3 {
            border: 3px solid black;
            display: flex;
            margin-bottom: 5px;
            height: 100px;
        }

        img {
            width: 130px;
        }

        .text-center {
            text-align: center;
        }

        h6 {
            margin: 0;
        }

        .logo-kiri {
            width: 30%;
            float: left;
        }

        .kiri {
            width: 50%;
            float: left;
        }

        .kiri-bawah {
            width: 65%;
            float: left;
        }

        .logo-kanan {
            width: 20%;
            float: right;
            text-align: right;
        }

        .kanan {
            width: 50%;
            float: right;
            text-align: right;
        }

        .kanan-ttd {
            width: 35%;
            float: right;
        }

        .kop {
            width: 70%;
            float: left;
        }

        img {
            width: 110px;
        }

        p {
            text-align: justify
        }
    </style>
</head>

<body>
    <div>
        <div class="logo-kiri text-center">
            <img src="{{ asset('images/LOGO POLNEP (PNG).png') }}" alt="Logo">
        </div>
        <div class="kop">
            <h6 class="text-center">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN,</h6>
            <h6 class="text-center">RISET DAN TEKNOLOGI</h6>
            <h6 class="text-center">POLITEKNIK NEGERI PONTIANAK</h6>
            <h6 class="text-center">Jalan Jenderal Ahmad Yani - Pontianak 78124, Kalimantan Barat</h6>
            <h6 class="text-center">Telepon: (0561)736180, Faksimile: (0561) 740143, Kotak Pos 1286</h6>
            <h6 class="text-center"><a href="http://www.polnep.ac.id/">Laman www.polnep.ac.id</a></h6>
        </div>
    </div>
    <table class="text-center" style="width:100%; margin-bottom:10px; padding-bottom:100px;">
    </table>
    <hr>
    <br>
    <table border="0" style="width: 100%;">
        <tbody>
            <tr>
                <td width="93">No</td>
                <td width="8">:</td>
                <td width="250">730/PL16.A3/EP/2023</td>
                <td></td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>-</td>
                <td></td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td style="font-weight: bold; text-decoration: underline;">Surat Peringatan I</td>
                <td></td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td>Yth. <span style="font-weight: bold;">Sdr. TRI BUDI ISMIRANDHA</span></td>
                <td valign="top">
                    <div align="right" style="font-weight: bold;">NIM. 3202216095</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><span style="font-weight: bold">Semester 3 Kelas E</span></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Mahasiswa Jurusan Teknik Elektro</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Prodi Teknik Informatika</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Politeknik Negeri Pontianak</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <br>
    <p>
        Berdasarkan Rekapitulasi aktifitas kehadiran Saudara sampai minggu ke - 1 semester Ganjil Tahun Akademik
        2023/2024, jumlah ketidakhadiran (alpa) telah mencapai 16 jam.
    </p>
    <p>
        Oleh karena itu berdasarkan Buku Peraturan Direktur tentang Penyelenggaraan Pendidikan Politeknik Negeri
        Pontianak Pasal 18 ayat 6 (huruf a), Saudara dinyatakan telah mendapatkan Surat Peringatan I (SP I).
    </p>
    <p>
        Bilamana jumlah ketidakhadiran Saudara mencapai >= 32 Jam akan mendapat Surat Peringatan II (SP II) berdasarkan
        Buku Peraturan Direktur tentang Penyelenggaraan Pendidikan Politeknik Negeri Pontianak Pasal 18 ayat 6 (huruf
        b).
    </p>
    <p>
        Demikianlah kami sampaikan, atas perhatian Saudara diucapkan terima kasih.
    </p><br><br>

    <table width="100%">
        <tr>
            <td valign="top" width="65% " style="height: 150px;">
                <br>
                <h6>Mengetahui :</h6>
                <h6>Wakil Direktur I</h6>
            </td>
            @php
                $tanggal = date('d F Y');
            @endphp
            <td valign="top">
                <h6>Pontianak, {{ $tanggal }}</h6>
                <h6>Ketua</h6>
                <h6>Jurusan Teknik Elektro</h6>
            </td>
        <tr>
            <td valign="bottom">
                <h6>H. IRAWAN SUHARTO</h6>
                <h6>NIP. 197103111998021001</h6>
            </td>
            <td valign="bottom">
                <h6>HASAN</h6>
                <h6>NIP. 197108201999031003</h6>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 100px; padding-bottom: 18px">
                <h6>Tembusan disampaikan kepada Yth :</h6>
                <h6>1. Orang Tua / Wali Mahasiswa</h6>
                <h6>2. PPMPP</h6>
                <h6>3. Dosen Pembimbing Akademik</h6>
                <h6>4. Arsip </h6>
            </td>
            <td valign="bottom">
                <h6 style="font-size:x-small; font-weight:lighter">File : SURAT SP 1 Genap 2022-2023</h6>
            </td>
        </tr>
    </table>
</body>

</html>
