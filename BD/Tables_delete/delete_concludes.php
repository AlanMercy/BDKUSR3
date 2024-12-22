<?php
include "../php/config.php";
include "../php/header.php";

if (isset($_GET['number_c']) && isset($_GET['pass_num_cl'])) {
    $number_c = urldecode($_GET['number_c']);
    $pass_num_cl = urldecode($_GET['pass_num_cl']);

    $sql = 'DELETE FROM public.concludes WHERE number_c = :number_c AND pass_num_cl = :pass_num_cl';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'number_c' => $number_c,
        'pass_num_cl' => $pass_num_cl
    ]);
}

header("Location: ../Tables/concludes.php");
exit;
?>
