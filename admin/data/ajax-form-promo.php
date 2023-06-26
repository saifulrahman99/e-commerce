<?php

//Including Database configuration file.

require_once '../../assets/basis/kon.php';

//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {

    //Search box value assigning to $Name variable.

    $Name = $_POST['search'];

    //Search query.

    $Query = "SELECT id_produk,nm_produk,kode_produk FROM produk WHERE nm_produk LIKE '%$Name%' OR kode_produk LIKE '%$Name%' LIMIT 5";

    //Query execution

    $ExecQuery = MySQLi_query($db, $Query);

    //Creating unordered list to display result.

    echo "<ul class=\"list-group\" style=\"position:absolute !important;top:66px;z-index:3;\">";

    //Fetching result from database.

    while ($Result = MySQLi_fetch_array($ExecQuery)) {

?>

        <!-- Creating unordered list items.

        Calling javascript function named as "fill" found in "script.js" file.

        By passing fetched result as parameter. -->

        <li id="list-group-form-promo" onclick="fill('<?= $Result['id_produk'] ?>')" class="list-group-item">
            <a>

                <!-- Assigning searched result in "Search box" in "search.php" file. -->

                <?= $Result['kode_produk'] . " - " . $Result['nm_produk'] ?>

            </a>
        </li>

        <!-- Below php code is just for closing parenthesis. Don't be confused. -->

<?php

    }
}
?>
</ul>
