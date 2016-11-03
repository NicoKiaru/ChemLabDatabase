<?if (isset($nom_tmp_MSDS)) {
				$nom_MSDS = "MSDS_".$id_product.".pdf";
				$path_MSDS = $MSDS_PATH;
				$resultat = move_uploaded_file($nom_tmp_MSDS,$path_MSDS.$nom_MSDS);
				if ($resultat) {echo "MSDS sucessfully uploaded. <br>";
					$sql = "
						UPDATE `product` 
						SET `MSDS_Internal` = '1' 
						WHERE `product`.`id` ='".$id_product."' LIMIT 1 ;
					";
					mysql_query($sql);			
				} else {echo "Error : MSD Sheet upload failed. <br>";};
				}				
			if (isset($nom_tmp_IS)) {
				$nom_IS = "Information_Sheet_".$id_product.".pdf";
				$path_IS = $IS_PATH;
				$resultat = move_uploaded_file($nom_tmp_IS,$path_IS.$nom_IS);
				if ($resultat) {echo "Information sheet sucessfully uploaded. <br>";
					$sql = "
					UPDATE `product` 
					SET `Infos_Internal` = '1' 
					WHERE `product`.`id` ='".$id_product."' LIMIT 1 ;
				";
				mysql_query($sql);			
				} else {echo "Error : Information sheet upload failed. <br>";};
				} ?>
