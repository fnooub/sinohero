<?php
	include 'Paginate.php';
	$file = 'http://res.cloudinary.com/fivegins/raw/upload/v1656517312/luufiles/Tr%E1%BB%9F_Th%C3%A0nh_Th%C3%A1nh_Nh%C3%A2n_L%C3%A0_Lo%E1%BA%A1i_G%C3%AC_Tr%E1%BA%A3i_Nghi%E1%BB%87m_1_eay2jm.txt';
	$nd = file_get_contents($file);

	$data = explode("[nextpage]", $nd);
	array_shift($data);
	$total = count($data);


	$config['current_page'] = isset($_GET['c']) ? $_GET['c'] : 1;
	$config['total_rows'] = $total;
	$config['base_url'] = 'chap.php?c=(:num)';
	$config['per_page'] = 1;
	$config['num_links'] = 7;
	$config['prev_link'] = '&laquo; Trước';
	$config['next_link'] = 'Sau &raquo;';

	$paginate = new Paginate();
	$paginate->initialize($config);

	$data = $paginate->get_array($data);

	foreach ($data as $row) {
		preg_match('/\[chuong\](.*?)\[\/chuong\]/', $row, $chuong);
		preg_match('#\[nd\](.*?)\[\/nd\]#is', $row, $nd2);
		echo '<h1>' . $chuong[1] . '</h1>';
		echo '<p>' . nl2br($nd2[1]) . '</p>';
	}

	echo $paginate->create_links();		