<?php
include 'config/proses.php';
$kas = new Config_uangkas();
$data_kas = $kas->view_uangkas();


?>

<html>
<head>
	<title>Export Data</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pemasukan Kas.xls");
	?>
 
	<center>
		<h1>Data Kas</h1>
	</center>
 
	<table border="1">
		<thead>
			<?php $no = 1; ?>
			<tr>
				<th>No</th>
	            <th>Nama</th>
	            <th>Uang Masuk</th>
	            <th>Keterangan</th>
	            <th>Tanggal</th>
	        </tr>
        </thead>
        <?php foreach($data_kas as $all_data) : ?>
        <tbody>
		<tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $all_data['bayar_anggota']; ?></td>
            <td><?php echo $all_data['nominal_cash']; ?></td>
            <td><?php echo $all_data['ket_pembayaran']; ?></td>
            <td><?php echo $all_data['tgl_masuk']; ?></td>
		</tr>
		</tbody>
		<?php $no++; ?>
		<?php endforeach; ?>
	</table>
</body>
</html>