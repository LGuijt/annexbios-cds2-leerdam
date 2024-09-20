<?php
include_once './core/db_connect.php';

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // If not authenticated, redirect to the login page
    header("Location: login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['delete'])) {
        // var_dump($_POST['vouchers']);
        foreach ($_POST['vouchers'] as $voucher) {
            $deletevoucher = $con->prepare("DELETE FROM vouchers WHERE id = ?");
            $deletevoucher->bind_param("i", $voucher);
            $deletevoucher->execute();
        }
    } else if (isset($_POST['add'])) {
        echo "add";
        $createvoucher = $con->prepare("INSERT INTO vouchers (code, amount) VALUES (?, ?)");
        $createvoucher->bind_param("si", $code, $amount);
        $code = $_POST['vouchercode'];
        $amount = $_POST['discount'];
        $createvoucher->execute();
    }
}

$readvoucher = $con->prepare("SELECT id, code, amount FROM vouchers");
$readvoucher->bind_result($rId, $rCode, $rAmount);
$readvoucher->execute();
?>

<?php include 'core/header.php'; ?>
<div id="a-parentcontainer">
    <div class="panel-container">
        <div class="panel-title">All vouchers</div>
        <form action="admin" method="post" id="formD">
            <div class="voucher-container">
                <div class="voucherdel">
                    <div></div>
                    <spam>Voucher_ID</spam>
                    <spam>Code</spam>
                    <spam>Korting</spam>
                </div>
                <?php
                while ($readvoucher->fetch()) {
                    ?>
                    <div class="voucherdel">
                        <input type="checkbox" name="vouchers[]" value="<?= $rId ?>">
                        <span><?= $rId ?></span>
                        <span><?= $rCode ?></span>
                        <span><?= $rAmount ?></span>
                    </div>
                    <?php
                }
                ?>
            </div>
            <input type="submit" name="delete" value="Delete Selected Vouchers" form="formD">
        </form>
    </div>
    <div class="panel-container">
        <div class="panel-title">Add new voucher</div>
        <form action="admin" method="post" id="formC">
            <div class="voucher-container" id="voucheradd">
                <label for="vouchercode">Vouchercode</label>
                <input type="text" name="vouchercode" id="vouchercode">
                <label for="discount">Discount</label>
                <input type="number" name="discount" id="discount">
            </div>
            <input type="submit" name="add" value="Add Voucher" form="formC">
        </form>
    </div>
</div>



<?php include 'core/footer.php'; ?>