<?php
include "../php/config.php";

if (isset($_GET['pass_num_w'])) {
    $pass_num_w = $_GET['pass_num_w'];

    $sql = 'DELETE FROM public.worker WHERE pass_num_w = :pass_num_w';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['pass_num_w' => $pass_num_w]);

    header("Location: ../Tables/workers.php");
    exit;
} else {
    header("Location: ../Tables/workers.php");
    exit;
}
?>
