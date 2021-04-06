<?php
include 'config/proses.php';
$catatan = new Config_uangkas();
$data_catatan = $catatan->view_catatan();


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
	header("Content-Disposition: attachment; filename=Catatan Pengeluaran Kas.xls");
	?>
 
	<center>
		<h1>Catatan Pengeluaran Kas</h1>
	</center>
 
	<table border="1">
		<thead>
			<?php $no = 1; ?>
			<tr>
				<th>No</th>
	            <th>Catatan</th>
	            <th>Nominal Uang</th>
	            <th>Tanggal</th>
	        </tr>
        </thead>
        <?php foreach($data_catatan as $all_data) : ?>
        <tbody>
		<tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $all_data['catatan']; ?></td>
            <td><?php echo $all_data['nominal_uang']; ?></td>
            <td><?php echo $all_data['tanggal']; ?></td>
		</tr>
		</tbody>
		<?php $no++; ?>
		<?php endforeach; ?>
	</table>
</body>
</html>