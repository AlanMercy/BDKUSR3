<?php
include "../php/config.php";

if (isset($_GET['number_c'])) {
    $number_c = urldecode($_GET['number_c']);

    $sql = 'DELETE FROM public.contract WHERE number_c = :number_c';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['number_c' => $number_c]);

    header("Location: ../Tables/contracts.php");
    exit;
} else {
    header("Location: ../Tables/contracts.php");
    exit;
}
?>
