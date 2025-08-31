<!DOCTYPE html>
    <!-- Membuat Tabel HTML dengan Looping -->
<html>
    <body>
    <table border="1" cellpadding="5">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>NIM</th>
        </tr>
        <?php
        $i = 1;
        $no = 101;
        $umur = 20;
        $nim = 220118001;
        while ($i <= 5) {
        ?>
        <tr>
            <td><?= $no ?></td>
            <td>Andi</td>
            <td><?= $umur ?></td>
            <td><?= $nim ?></td>
        </tr>
        <?php
            $i++;
            $no++;
            $umur++;
            $nim++;
        }
        ?>
    </table>
    </body>
</html>