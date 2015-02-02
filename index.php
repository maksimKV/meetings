<?php
	/*	Note
	 * In this script I find the required dates and save to the maksim.csv file.
	 *
	 * I decided it is also good to have a visual representation in the browser of what the csv file looks like
	 * that's why I have made an html table with all the data.
	 */

	$spreadsheet = fopen('maksim.csv', 'w');

	fputcsv($spreadsheet, array('Month', 'Mid Month Meeting Date', 'End of Month Testing Date'), ';');

	echo "<html>
	<head><title>Maksim Kanev's Test</title></head>
	<body>
	<table>
	<tr>
		<th>Month</th>
		<th>Mid Month Meeting Date</th>
		<th>End of Month Testing Date</th>
	</tr>";

	for($i = 0; $i < 6; $i++){
		$month = date('F', strtotime('+' . $i . ' month'));
		$meeting = date('Y-m-14', strtotime('+' . $i . ' month'));
		$testing = date('Y-m-t',  strtotime('+' . $i . ' month'));

		if (date('l', strtotime($meeting)) == "Saturday" || date('l', strtotime($meeting)) == "Sunday"){
			$meeting = date('Y-m-d', strtotime('next monday' . $meeting));
		}

		if (date('l', strtotime($testing)) == "Friday" || date('l', strtotime($testing)) == "Saturday" || date('l', strtotime($testing)) == "Sunday"){
			$testing = date('Y-m-d', strtotime('last thursday' . $testing));
		}

		$meeting = date('d', strtotime($meeting));
		$testing = date('d', strtotime($testing));

		fputcsv($spreadsheet, array($month, $meeting, $testing));

		echo "<tr>
			<td>".$month."</td>
			<td>".$meeting."</td>
			<td>".$testing."</td>
		</tr>";
	}

	echo "</table>
	</body>
	</html>";
	fclose($spreadsheet);
?>