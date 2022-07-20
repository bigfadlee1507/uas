<?php
require 'koneksi.php';
?>
<html>
    <head>
        <title>Cetak Barcode</title>
        <style>
            table, td, th {
            border: 1px dotted black;
            }

            table {
            border-collapse: collapse;
            }
            .spas{
                width : 100%;
                height : 20px;
                background-color : #D3D3D3;
            }
            .hapusborder {
                    border-top-style: none;
                    border-left-style: none;
                    border-right-style: none;
                    border-bottom-style: none;
                }
        </style>
    </head>
    <body>
        
        <?php
        $no=1;
        $arr_barcode = array();
        $arr_nama = array();
        $arr_harga = array();
        $arr_id = array();
        $data_list_barang = mysqli_query($konek,"SELECT * FROM list");
        while($dlist = mysqli_fetch_assoc($data_list_barang)){
            $data_barang = mysqli_query($konek, "SELECT * FROM item WHERE barcode='$dlist[barcode]'");
            $dbarang = mysqli_fetch_assoc($data_barang);
            
            for($x=0;$x<$dlist["jml"];$x++){
                $arr_barcode[] = $dbarang["barcode"];
                $arr_nama[] = $dbarang["nama"];
                $arr_harga[] = $dbarang["harga"];
                $arr_id[] = $dbarang["id"];
            }
        }
        ?>
        <?php
        $jumlah = count($arr_barcode);
        ?>
        <table>
            <tr>
                <?php
                    for($j=0;$j<$jumlah;$j++){
                        if($j%4===0){
                        ?>
                        <tr></tr>
                        <td class="tabel" valign=top width=190><br>
                            <center><small><b><?= $arr_nama[$j]; ?></b></small></center>
                            <div class="spas"><center><small><?= $arr_barcode[$j]; ?></small></center></div>
                            
                            <center>Rp. &nbsp;<b><?= $arr_harga[$j]; ?></b>&nbsp;</center><br><br><br>
                            <small><center><?= $arr_id[$j]; ?></center></small>
                        </td>
                        <?php
                        } else {
                    ?>
                        <td class="tabel" valign=top width=190><br>
                            <center><small><b><?= $arr_nama[$j]; ?></b></small></center>
                            <div class="spas"><center><small><?= $arr_barcode[$j]; ?></small></center></div>
                            
                            <center>Rp. &nbsp;<b><?= $arr_harga[$j]; ?></b>&nbsp;</center><br><br><br>
                            <small><center><?= $arr_id[$j]; ?></center></small>
                        </td>
                    <?php
                        }
                    }
                ?>
            </tr>
        </table>
        
    </body>
    <script>
        window.print();
    </script>
</html>
