<?php
if ($_SESSION['status_login'] == false) { ?>
    <script>
        var base_url = window.location.origin + '/admin/';
        window.location.href = base_url+'login';
    </script>
<?php } ?>