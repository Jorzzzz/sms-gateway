<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS</title>
</head>
<body align="center">
    <form method="post" action="">
        <h2>Kirim SMS dengan PHP</h2>
        <table align="center">
            <tr>
                <td>
                    No.Tujuan :
                </td>
                <td>
                    <input type="text" name="no_tujuan">
                </td>
            </tr>
            <tr>
                <td>
                    Isi Pesan :
                </td>
                <td>
                    <textarea name="isi_pesan"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="bkirim">Kirim</button></td>
            </tr>
        </table>
    </form>

    <?php
    if(isset($_POST['bkirim'])){
        $no_tujuan = $_POST['no_tujuan'];
        $isi_pesan = $_POST['isi_pesan'];
        $sending = sendsms($no_tujuan, $isi_pesan);
        if($sending == "success"){
            echo "Pesan SMS berhasil dikirim!";
        }else{
            echo "Pesan SMS gagal dikirim!";
        }
    }
    function sendsms ($no_tujuan, $pesan)
    {
        $idmesin = "1394";
        $pin = "122935";
        $pesan = str_replace(" ", "%20", $pesan);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin=$pin&to=$no_tujuan&text=$pesan");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    ?>

</body>
</html>