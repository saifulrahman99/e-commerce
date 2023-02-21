<section id="home" class="home">
    <div class="container">

        <h2>Menu Home</h2>
        <br />
        <h2 align="center">Login Melalui Akun Google Menggunakan PHP</h2>
        <br />
        <p style="max-width:35vw; text-align:center; margin: auto; margin-bottom:1rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, voluptatem!.</p>
        <div class="panel panel-default">
            <?php
            if ($login_button == '') {
            ?>
                <div class="panel-heading">Welcome User</div>
                <div class="panel-body">
                    <img src="<?php echo $_SESSION['user_image'] ?>" alt="foto" style="border-radius: 50%;">
                    <h3><b>Name :</b> <?php echo $_SESSION['name'] ?></h3>
                    <h3><b>Email :</b> <?php echo $_SESSION['user_email_address'] ?></h3>
                    <h3><a href="logout.php">Logout</h3>
                </div>
            <?php } else { ?>
                <div align="center"><?php echo $login_button ?></div>
            <?php }
            ?>
        </div>
    </div>
</section>