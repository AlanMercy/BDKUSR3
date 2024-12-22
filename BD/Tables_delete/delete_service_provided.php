<?php
include "../php/config.php";

if (isset($_GET['id_pr'])) {
    $id_pr = urldecode($_GET['id_pr']);

    $sql = 'DELETE FROM public.services_provided WHERE id_pr = :id_pr';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_pr' => $id_pr]);

    header("Location: ../Tables/services_provided.php");
    exit;
} else {
    header("Location: ../Tables/services_provided.php");
    exit;
}
?>
