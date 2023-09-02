<?php
session_start();

require_once '../../assets/basis/kon.php';

if (isset($_POST['login'])) {


    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $query = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username' AND password = '$password'");

    $id_admin = mysqli_fetch_assoc($query);
    setcookie('id_admin', $id_admin['id_akun'], time() + (60 * 60 * 24 * 3));

    $s_admin = mysqli_num_rows($query);

    if ($s_admin > 0) {

        mysqli_query($db, "UPDATE akun SET status_online = '1'");

        if ($_POST['remember'] == '1') {
            setcookie('username', "$username", time() + (60 * 60 * 24 * 3));
            setcookie('password', "$password", time() + (60 * 60 * 24 * 3));
        }
        $_SESSION['status_login'] = true;
        header('location:login');
    } else { ?>
        <script type="text/javascript">
            alert('Gagal Login');
        </script>
<?php
        header('location:login');
    }
}
