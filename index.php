<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Penilaian Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4">Form Penilaian Mahasiswa</h2>
    <form method="POST" class="card p-4 shadow">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" class="form-control" name="nim" id="nim" required>
        </div>
        <div class="mb-3">
            <label for="kehadiran" class="form-label">Nilai Kehadiran (%)</label>
            <input type="number" class="form-control" name="kehadiran" id="kehadiran" min="0" max="100" required>
        </div>
        <div class="mb-3">
            <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
            <input type="number" class="form-control" name="tugas" id="tugas" min="0" max="100" required>
        </div>
        <div class="mb-3">
            <label for="uts" class="form-label">Nilai UTS (30%)</label>
            <input type="number" class="form-control" name="uts" id="uts" min="0" max="100" required>
        </div>
        <div class="mb-3">
            <label for="uas" class="form-label">Nilai UAS (40%)</label>
            <input type="number" class="form-control" name="uas" id="uas" min="0" max="100" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary w-100">Proses</button>
    </form>

    <?php if (isset($_POST['submit'])):
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $kehadiran = $_POST['kehadiran'];
        $tugas = $_POST['tugas'];
        $uts = $_POST['uts'];
        $uas = $_POST['uas'];

        $nilaiAkhir = ($kehadiran * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);

        if ($nilaiAkhir >= 85) $grade = "A";
        elseif ($nilaiAkhir >= 70) $grade = "B";
        elseif ($nilaiAkhir >= 55) $grade = "C";
        elseif ($nilaiAkhir >= 40) $grade = "D";
        else $grade = "E";

        if ($kehadiran < 70) {
            $status = "TIDAK LULUS";
        } elseif ($nilaiAkhir >= 60 && $kehadiran > 70 && $tugas >= 40 && $uts >= 40 && $uas >= 40) {
            $status = "LULUS";
        } else {
            $status = "TIDAK LULUS";
        }

        $cardColor = $status == "LULUS" ? "success" : "danger";
        $btnColor = $status == "LULUS" ? "btn-success" : "btn-danger";
    ?>
        <div class="card mt-4 border-<?= $cardColor ?>">
            <div class="card-header bg-<?= $cardColor ?> text-white">Hasil Penilaian</div>
            <div class="card-body">
                <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
                <p><strong>NIM:</strong> <?= htmlspecialchars($nim) ?></p>
                <p><strong>Nilai Kehadiran:</strong> <?= $kehadiran ?>%</p>
                <p><strong>Nilai Tugas:</strong> <?= $tugas ?></p>
                <p><strong>Nilai UTS:</strong> <?= $uts ?></p>
                <p><strong>Nilai UAS:</strong> <?= $uas ?></p>
                <p><strong>Nilai Akhir:</strong> <?= number_format($nilaiAkhir, 2) ?></p>
                <p><strong>Grade:</strong> <?= $grade ?></p>
                <p><strong>Status:</strong> <?= $status ?></p>
            </div>
            <div class="card-footer text-end">
                <button class="btn <?= $btnColor ?>">Selesai</button>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>