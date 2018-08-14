<?php
/**
 * Capture the supplied amount.
 *
 * Use this call when fulfillment is completed, e.g. physical goods are
 * being shipped to the customer.
 */

require_once dirname(__DIR__) . '/../../../vendor/autoload.php';

$merchantId = getenv('MERCHANT_ID') ?: '0';
$sharedSecret = getenv('SHARED_SECRET') ?: 'sharedSecret';
$orderId = getenv('ORDER_ID') ?: '12345';

$connector = Klarna\Rest\Transport\Connector::create(
    $merchantId,
    $sharedSecret,
    Klarna\Rest\Transport\ConnectorInterface::EU_TEST_BASE_URL
);

try {
    $order = new Klarna\Rest\OrderManagement\Order($connector, $orderId);
    $captures = $order->fetchCaptures();

    foreach ($captures as $capture) {
        print_r($capture->getArrayCopy());
    }

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}