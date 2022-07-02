<?php
	
	$file = 'http://res.cloudinary.com/fivegins/raw/upload/v1656517312/luufiles/Tr%E1%BB%9F_Th%C3%A0nh_Th%C3%A1nh_Nh%C3%A2n_L%C3%A0_Lo%E1%BA%A1i_G%C3%AC_Tr%E1%BA%A3i_Nghi%E1%BB%87m_1_eay2jm.txt';
	$nd = file_get_contents($file);

	$data = explode("[nextpage]", $nd);
	array_shift($data);

	foreach ($data as $key => $value) {
		preg_match('/\[chuong\](.*?)\[\/chuong\]/', $value, $chuong);
		echo '<a href="' . base_url() . 'posts/chap/' . $id . '?c=' . ($key+1) . '"><h1>' . $chuong[1] . '</h1></a>';
	}