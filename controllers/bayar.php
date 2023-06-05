<?php

namespace Midtrans;

require_once 'vendor/payment/Midtrans.php';

//Set Your server key
Config::$serverKey = "SB-Mid-server-z-__Mmo5avW30d27vWSREhKd";

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => intval($total), // no decimal allowed for creditcard
);

// Optional
$billing_address = array(
    'first_name'    => "Andri",
    'address'       => "Mangga 20",
    'city'          => "Jakarta",
    'phone'         => "081122334455",
    'country_code'  => 'IDN'
);

// Optional
$customer_details = array(
    'first_name'    => "Andri",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    'billing_address'  => $billing_address,

);

// Optional, remove this to display all available payment methods
$enable_payments = array('bca_va', 'bni_va', 'bri_va', 'gopay', 'shopeepay', 'other_qris');
// $enable_payments = array('gopay');

// Fill transaction details
$transaction = array(
    'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
);

$snapToken = Snap::getSnapToken($transaction);
?>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-j1UwFlBeVMen-Fxd"></script>
<script type="text/javascript">

    document.getElementById('btn-bayar-belanjaan').onclick = function() {

        $.ajax({
            type: 'POST',
            url: "controllers/transaksi.php",
            data: $('#form-pembayaran').serialize(),
            success: function(data) {
                // document.getElementById('info-error').innerHTML = data;
                $('#modalCheckout').modal('hide');
                snap.pay('<?php echo $snapToken ?>');
            }
        });

    };

</script>