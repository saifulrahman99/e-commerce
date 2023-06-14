<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';

//Set Your server key
Config::$serverKey = "SB-Mid-server-z-__Mmo5avW30d27vWSREhKd";
// Config::$serverKey = "Mid-server-khIKLaZqaGlwbUArR1wWG68m";

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
    'gross_amount' => 94000, // no decimal allowed for creditcard
);

// Optional
$item1_details = array(
    'id' => 'a1',
    'price' => 18000,
    'quantity' => 3,
    'name' => "Apple"
);

// Optional
$item2_details = array(
    'id' => 'a2',
    'price' => 20000,
    'quantity' => 2,
    'name' => "Orange"
);

// Optional
$item_details = array($item1_details, $item2_details);

// Optional
$billing_address = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'address'       => "Mangga 20",
    'city'          => "Jakarta",
    'postal_code'   => "16602",
    'phone'         => "081122334455",
    'country_code'  => 'IDN'
);

// Optional
$shipping_address = array(
    'first_name'    => "Obet",
    'last_name'     => "Supriadi",
    'address'       => "Manggis 90",
    'city'          => "Jakarta",
    'postal_code'   => "16601",
    'phone'         => "08113366345",
    'country_code'  => 'IDN'
);

// Optional
$customer_details = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
);

// Optional, remove this to display all available payment methods
$enable_payments = array('bni_va', 'bri_va', 'gopay', 'echannel');

// Fill transaction details
$transaction = array(
    'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snapToken = Snap::getSnapToken($transaction);
echo "snapToken = " . $snapToken;
?>

<!DOCTYPE html>
<html>

<body>
    <button id="pay-button">Pay!</button>
    <!-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-j1UwFlBeVMen-Fxd"></script>
    <!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-8mpTS156jrQlXUpz"></script> -->
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snapToken ?>'
            // , {
            //     // Optional
            //     onSuccess: function(result) {
            //         /* You may add your own js here, this is just example */
            //         document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            //     },
            //     // Optional
            //     onPending: function(result) {
            //         /* You may add your own js here, this is just example */
            //         document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            //     },
            //     // Optional
            //     onError: function(result) {
            //         /* You may add your own js here, this is just example */
            //         document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            //     }
            // }
            );
        };
    </script>
</body>

</html>