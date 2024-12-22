<?php
include "../php/config.php";

if (isset($_GET['pass_num_cl'])) {
    $pass_num_cl = $_GET['pass_num_cl'];

    $sql = 'DELETE FROM public.client WHERE pass_num_cl = :pass_num_cl';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['pass_num_cl' => $pass_num_cl]);

    header("Location: ../Tables/clients_ser.php");
    exit;
} else {
    header("Location: ../Tables/clients_ser.php");
    exit;
}
?>
