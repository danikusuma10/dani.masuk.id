<form action="<?php echo site_url('Publik/search_keyword');?>" method = "post">
<input type="text" name = "keyword" />
<input type="submit" value = "Search" />
</form>

<table>
<?php foreach($results as $row){ ?>
    <tr>
        <td><?php echo $row->nama_siswa?></td>
        <td><?php echo $row->nik?></td>
        <td><?php echo $row->bulan_bayar?></td>
        <td><?php echo $row->tahun_bayar?></td>
        <td> <?php echo $row->jmlh_bayar?></td>
                                    
                                

        <td><?php echo $row->tgl_bayar?></td>
        <td><?php echo $row->nama_petugas?></td>
    </tr>
<?php } ?>
</table>