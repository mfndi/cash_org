<?php
include 'config/proses.php';
$all_anggota = new Show_anggota();
$data = $all_anggota->view_anggota();


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
	header("Content-Disposition: attachment; filename=Data Anggota.xls");
	?>
 
	<center>
		<h1>Data Anggota</h1>
	</center>
 
	<table border="1">
		<thead>
			<?php $no = 1; ?>
			<tr>
				<th>No</th>
	            <th>Nama</th>
	            <th>Nomer Telpon</th>
	            <th>Email</th>
	            <th>Tanggal lahir</th>
	            <th>Alamat</th>
	        </tr>
        </thead>
        <?php foreach($data as $all_data) : ?>
        <tbody>
		<tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $all_data['nama_anggota']; ?></td>
            <td><?php echo "+62" . $all_data['ponsel_anggota']; ?></td>
            <td><?php echo $all_data['email_anggota']; ?></td>
            <td><?php echo $all_data['tgl_lahir']; ?></td>
            <td><?php echo $all_data['alamat_anggota']; ?></td>
		</tr>
		</tbody>
		<?php $no++; ?>
		<?php endforeach; ?>
	</table>
</body>
</html>