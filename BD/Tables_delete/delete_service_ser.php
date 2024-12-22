<?php
include "../php/config.php";

if (isset($_GET['title_ser'])) {
    $title_ser = urldecode($_GET['title_ser']);

    $sql = 'DELETE FROM public.service WHERE title_ser = :title_ser';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title_ser' => $title_ser]);

    header("Location: ../Tables/services_ser.php");
    exit;
} else {
    header("Location: ../Tables/services_ser.php");
    exit;
}
?>
