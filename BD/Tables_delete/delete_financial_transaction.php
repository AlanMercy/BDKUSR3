<?php
include "../php/config.php";

if (isset($_GET['id_ft'])) {
    $id_ft = urldecode($_GET['id_ft']);

    $sql = 'DELETE FROM public.financial_transactions WHERE id_ft = :id_ft';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_ft' => $id_ft]);

    header("Location: ../Tables/financial_transactions.php");
    exit;
} else {
    header("Location: ../Tables/financial_transactions.php");
    exit;
}
?>
