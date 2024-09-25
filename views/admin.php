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
            $deleteVoucher = $con->prepare("DELETE FROM vouchers WHERE id = ?");
            $deleteVoucher->bind_param("i", $voucher);
            $deleteVoucher->execute();
        }
    } else if (isset($_POST['add'])) {
        echo "add";
        $createVoucher = $con->prepare("INSERT INTO vouchers (code, amount) VALUES (?, ?)");
        $createVoucher->bind_param("si", $code, $amount);
        $code = $_POST['vouchercode'];
        $amount = $_POST['discount'];
        $createVoucher->execute();
    }
}

$readVoucher = $con->prepare("SELECT id, code, amount FROM vouchers");
$readVoucher->bind_result($rId, $rCode, $rAmount);
$readVoucher->execute();
?>

<?php include 'core/header.php'; ?>
<div id="aParentContainer">
    <div class="panelContainer">
        <div class="panelTitle">All vouchers</div>
        <form action="admin" method="post" id="formD">
            <div class="voucherContainer">
                <div class="voucherDel">
                    <div></div>
                    <spam>Voucher_ID</spam>
                    <spam>Code</spam>
                    <spam>Korting</spam>
                </div>
                <?php
                while ($readVoucher->fetch()) {
                    ?>
                    <div class="voucherDel">
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
    <div class="panelContainer">
        <div class="panelTitle">Add new voucher</div>
        <form action="admin" method="post" id="formC">
            <div class="voucherContainer" id="voucherAdd">
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