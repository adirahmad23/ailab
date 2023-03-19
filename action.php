<?php

//action.php

session_start();

if (isset($_POST["action"])) {
	if ($_POST["action"] == "add") {
		if (isset($_SESSION["pinjam_cart"])) {
			$is_available = 0;
			foreach ($_SESSION["pinjam_cart"] as $keys => $values) {
				if ($_SESSION["pinjam_cart"][$keys]['idbarang'] == $_POST["idbarang"]) {
					$is_available++;
					$_SESSION["pinjam_cart"][$keys]['kuantiti'] = $_SESSION["pinjam_cart"][$keys]['kuantiti'] + $_POST["kuantiti"];
				}
			}
			if ($is_available == 0) {
				$item_array = array(
					'idbarang'               =>     $_POST["idbarang"],
					'namabarang'             =>     $_POST["namabarang"],
					'merek'          	     =>     $_POST["merek"],
					'kuantiti'         		 =>     $_POST["kuantiti"],
					'kdbarang'        		 =>     $_POST["kdbarang"]
				);
				$_SESSION["pinjam_cart"][] = $item_array;
			}
		} else {
			$item_array = array(
				'idbarang'               =>     $_POST["idbarang"],
				'namabarang'             =>     $_POST["namabarang"],
				'merek'          		 =>     $_POST["merek"],
				'kuantiti'         		 =>     $_POST["kuantiti"],
				'kdbarang'        		 =>     $_POST["kdbarang"]
			);
			$_SESSION["pinjam_cart"][] = $item_array;
		}
	}

	if ($_POST["action"] == 'remove') {
		foreach ($_SESSION["pinjam_cart"] as $keys => $values) {
			if ($values["idbarang"] == $_POST["idbarang"]) {
				unset($_SESSION["pinjam_cart"][$keys]);
			}
		}
	}
	if ($_POST["action"] == 'empty') {
		unset($_SESSION["pinjam_cart"]);
	}
}
