<?php
session_start();
require_once '../../assets/basis/kon.php';
require_once '../function/base_url.php';

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$key = hash('sha256', "$password$username");

if (!empty($_POST['username'])) {
    $ubah_username = mysqli_query($db, "UPDATE akun SET username = '$username'");
    if ($ubah_username) {
        mysqli_query($db, "UPDATE akun SET key = '$key'");
    }
}

if (!empty($_POST['password'])) {
    $ubah_pass = mysqli_query($db, "UPDATE akun SET password = '$password'");
    if ($ubah_pass) {
        mysqli_query($db, "UPDATE akun SET key = '$key'");
    }

    if ($ubah_username || $ubah_pass) {
?>
        <script>
            alert('Berhasil mengubah data akun');
        </script>
    <?php
    }
}

if (empty($_POST['username']) && empty($_POST['password'])) {
    ?>
    <script>
        alert('Data akun tidak ada yang dirubah');
    </script>
<?php
}
session_destroy();
?>
<script>
    window.location.href = '<?= base_url('adastra') ?>'
    l
</script>