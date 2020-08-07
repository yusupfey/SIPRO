<style>
    th {
        height: 40px;
        size: 12px;
        background-color: #ddd;
    }

    td {
        text-align: center;
    }
</style>
<h1>
    <center>LAPORAN PENJUALAN SIPRO</center>
    <center><?= $name ?></center>
</h1>
<br>
<br>
<table width="100%" border="1" style="border:1px solid; border-collapse:collapse;">
    <thead>
        <tr>
            <th>Pembeli</th>
            <th>Perumahan</th>
            <th>Cluster</th>
            <th>Type</th>
            <th>ALamat</th>
            <th>Tanggal Booking</th>
            <th>Tanggal Jual</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($terjual as $p) : ?>
            <tr>
                <td><?= @$p->nama ?></td>
                <td><?= @$p->nm_perumahan ?></td>
                <td><?= @$p->claster ?></td>
                <td><?= @$p->type ?></td>
                <td><?= @$p->alamat ?></td>
                <td><?= $p->tgl_booking ?></td>
                <td><?= $p->tgl_jual ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>