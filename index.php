<?php
    require 'koneksi.php';
    if(isset($_POST["masukan"])){
        $kode = addslashes($_POST["kode"]);
        $nama = addslashes($_POST["nama"]);
        $jumlah = addslashes($_POST["jumlah"]);
        $b_1 = mysqli_query($konek,"SELECT MAX(id) as mk_id FROM list");
        $b_2 = mysqli_fetch_assoc($b_1);
        $idbaru = $b_2["mk_id"]+1;
        $masuk = mysqli_query($konek,"INSERT INTO list VALUES('$idbaru','$kode','$jumlah')");
        if($masuk){
            echo "<script>document.location.href='index.php';</script>";
        } else {
            
        }
        
    }
    if(isset($_GET["hapus"])){
        $del = $_GET["hapus"];
        $masuk = mysqli_query($konek,"DELETE FROM list WHERE id='$del'");
        if($masuk){
            echo "<script>document.location.href='index.php';</script>";
        } else {
            
        }
    }
?>
<html>
    <head>
        <title>UAS SUKMA FADLY NURLANA</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            .head{
                padding: 8px;
                color : #FFFAF0;
                background-color : #92a8d1;
            }
            .headtable{
                background-color : lightblue;
            }
            .headtable-th{
                background-color : #f0f2f4;
            }
            .spas{
                width : 100%;
                height : 25px;
                background-color : #f8f8f8;
            }
            .form-disable{
                width: 100%;
                
                /* padding: 12px 20px; */
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
                resize: none;
            }
            .form-focus{
                width: 100%;
                
                margin: 8px 0;
                box-sizing: border-box;
                border: 3px solid #ccc;
                -webkit-transition: 0.5s;
                transition: 0.5s;
                outline: none;
            }
            .form-focus:focus{
                border : 3px solid #00BFFF;
            }
            .tombol {
            background-color: #D3D3D3;
            border: none;
            color: white;
           
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="head">
            <b>PRINT BARCODE RAK</b>
        </div>
        <div class="spas"></div>

        
        
        <table cellpadding="0" cellspacing="0"><form action="" method="POST">
            <tr class="headtable-th">
                <td>
                    <input class="form-focus" type="text" name="kode" id="kodebarcode">
                </td>
                <td><input type="text" class="form-disable" id="kodenama" name="nama" ></td>
                <th>&nbsp;
                    
                    <button type="button" class="tombol" data-toggle="modal" data-target="#modalbarang">
                        <img src="image/search.png" width="13px" alt="">
                    </button>
                    &nbsp;
                        <!-- Modal -->
                            <div class="modal fade" id="modalbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Data Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table style="width:100%">
                                        <tr class="headtable-th">
                                            <th>No.</th>
                                            <th>&nbsp;</th>
                                            <th>Id</th>
                                            <th>Barcode</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>SATUAN</th>
                                        </tr>
                                        <?php
                                        $no=1;
                                        $daftar_item = mysqli_query($konek,"SELECT * FROM item ORDER BY nama ASC");
                                        while($data_barang = mysqli_fetch_assoc($daftar_item)){
                                        ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <th align=center>
                                                <button class="tombol" type="button" id="select" 
                                                data-id="<?= $data_barang["id"]; ?>" 
                                                data-barcode="<?= $data_barang["barcode"]; ?>" 
                                                data-nama="<?= $data_barang["nama"]; ?>"><img src="image/plus.png" width="13px" alt=""> Pilih</button>
                                            </th>
                                            <td><?= $data_barang["id"]; ?></td>
                                            <td><?= $data_barang["barcode"]; ?></td>
                                            <td><?= $data_barang["nama"]; ?></td>
                                            <td><?= $data_barang["harga"]; ?></td>
                                            <td><?= $data_barang["satuan"]; ?></td>
                                        </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
            <!-- tutup modal -->
                </th>
                <td><input class="form-focus" type="text" name="jumlah" id="kodejumlah" required></td>
                <td>&nbsp;<button class="tombol" name="masukan"><img src="image/plus.png" width="13px" alt=""> Masukan</button>&nbsp;</td>
            </tr></form>
            <tr class="headtable">
                <th width="120">Kode/BC</th>
                <th width="250">Nama</th>
                <th width="50">Jml</th>
                <th width="100">&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </table>
        
        <table>
        <?php
        $data_list_barang = mysqli_query($konek,"SELECT * FROM list");
        while($dlist = mysqli_fetch_assoc($data_list_barang)){
            $data_barang = mysqli_query($konek, "SELECT * FROM item WHERE barcode='$dlist[barcode]'");
            $dbarang = mysqli_fetch_assoc($data_barang);
        ?>
            <tr>
                <td width="120"><?= $dlist["barcode"]; ?></td>
                <td width="250"><?= $dbarang["nama"]; ?></td>
                <td width="250">
                    <?php
                    if($dlist["jml"]<=0){
                        $ctk = 1;
                    } else {
                        $ctk = $dlist["jml"];
                    }
                    echo "$ctk";
                    ?>
                </td>
                <td>&nbsp;</td>
                <td><a href="?hapus=<?= $dlist["id"]; ?>"><img src="image/silang.png" width="13px" alt=""></a></td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan=5><a href="cetak.php"><button>Cetak</button></a></td>
            </tr>
        </table>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $(document).on('click', '#select', function() {
                    var item_id = $(this).data('id');
                    var item_barcode = $(this).data('barcode');
                    var item_nama = $(this).data('nama');
                    $('#kodebarcode').val(item_barcode);
                    $('#kodenama').val(item_nama);
                    $('#modalbarang').modal('hide');
                })
            })
        </script>
        
    </body>
</html>
