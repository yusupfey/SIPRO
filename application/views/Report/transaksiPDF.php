<style>
    th {
        height: 40px;
        size: 12px;
        background-color: #ddd;
    }

    span {
        size: 14px;
    }

    td {
        text-align: center;
    }

    center {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
</style>
<h1>
    <center>LAPORAN PEMBELIAN<br> PAKET PERUMAHAN
        <span>SIPRO</span>
    </center>
    <hr>
</h1>
<br>
<br>
<table width="100%" border="1" style="border:1px solid; border-collapse:collapse;">
    <thead>
        <tr>
            <th>Pembeli</th>
            <th>Nama Perumahan</th>
            <th>Paket</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trans as $p) : ?>
            <tr>
                <td><?= $p->nama ?></td>
                <td><?= @$p->nm_perumahan ?></td>
                <td><?= @$p->jml . @$p->keterangan ?></td>
                <td><?= @$p->tanggal ?></td>
                <td><?= @$p->ket ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>