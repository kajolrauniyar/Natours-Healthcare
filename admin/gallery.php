<?php 

	require 'inc/config.php';
	require 'inc/functions.php';
	require 'inc/logincheck.php';
	 
	if (isset($_POST) && !empty($_POST)) {
		$gallery_data= array(
							'title' 		=> sanitize($_POST['title']),
							'description' 	=> sanitize($_POST['description']),
							'status' 		=> sanitize($_POST['status']),
							'added_by' 		=> $_SESSION['user_id']
						);
		/*cover picture*/
		//debugger($_POST);
		//debugger($_FILES, true);

		 
		if (isset($_POST['delete_cover_image']) && !empty($_POST['delete_cover_image']) && file_exists(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['delete_cover_image'])) {
			unlink(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['delete_cover_image']);
			$gallery_data['cover_pic'] = NULL;
		}

		if (!isset($_POST['last_path'])  && empty($_POST['id'])) {
			 $upload_dir = UPLOAD_DIR."/".'gallery'."/";
        	if (!is_dir($upload_dir)) {
        		mkdir($upload_dir, 0755, true);
        	}
        	$upload_dir .= date('Y-m-d');
        	if (!is_dir($upload_dir)) {
        		mkdir($upload_dir, 0755, true);
        	}
        	$upload_dir .="/".strtolower(getPlainText($_POST['title']));
        	if (!is_dir($upload_dir)) {
        		mkdir($upload_dir, 0755, true);
        	}
        	$path_dir = $upload_dir;
        	$upload_path_to_access = explode("/", $path_dir);
        	$last_location = array_pop($upload_path_to_access);
        	$second_location = array_pop($upload_path_to_access);
        	$third_location = array_pop($upload_path_to_access);
        	$database_location = $third_location."/".$second_location."/".$last_location;
        	$gallery_data['path'] = $database_location;
		} else{
			$path_dir = UPLOAD_DIR.'/'.$_POST['last_path'];
			$gallery_data['path'] = $_POST['last_path'];
		}


 

		if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
			
			$ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
			if (in_array(strtolower($ext), ALLOWED_EXTENSIONS)) {
				if ($_FILES['thumbnail']['size'] <= 5000000) {

					$file_name =getPlainText($_POST['title'])."-".date('Ymdhis').rand(0, 999).".".$ext;
					$success = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path_dir.'/'.$file_name);
					if ($success) {
						$gallery_data['cover_pic'] = $file_name;

						if (isset($_POST['old_image_cover_pic']) && !empty($_POST['old_image_cover_pic']) && file_exists(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['old_image_cover_pic'])) {
							unlink(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$_POST['old_image_cover_pic']);
						}

					}
				}
			}
		}
		$gallery_id = isset($_POST['gallery_id']) && !empty($_POST['gallery_id']) ? (int)$_POST['gallery_id'] : null;
		if ($gallery_id) {
			$act  = 'updat';
			$pull_gallery_id_for_other_images = updateData('galleries', $gallery_data, $gallery_id);
		} else{
			$act = 'add';
			$pull_gallery_id_for_other_images = addData('galleries', $gallery_data);
		}

		




		

		//$gallery_id = addData('galleries', $gallery_data);
		/*debugger($gallery_id);
		debugger($_FILES, true);*/
		if (isset($_FILES['other_images']) && !empty($_FILES['other_images'])) {
			$files = $_FILES['other_images'];

			$no_of_files = count($files['name']);
		 
			for ($i=0; $i<$no_of_files; $i++) { 
				
				$ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
				 
				if (in_array(strtolower($ext), ALLOWED_EXTENSIONS)) {
					if ($files['size'][$i] <= 5000000) {

						$file_name =getPlainText($_POST['title']).'-'.'other_images'."-".date('Ymdhis').rand(0, 999).".".$ext;
						$success = move_uploaded_file($files['tmp_name'][$i], $path_dir.'/'.$file_name);

						if ($success) {
							$temp = array(
								'gallery_id'	=> $pull_gallery_id_for_other_images,
								'image_name' 	=> $file_name
							);

							$success= addData('gallery_images', $temp);
							echo  $success;

						}
					}
				}
			}
		} 

		//debugger($_POST);
		//debugger($_FILES, true);
		 /*to delete sigle image chosing specifically*/
		if (isset($_POST['delete_image']) && !empty($_POST['delete_image'])) {
			foreach ($_POST['delete_image'] as $delete_image) {
				$success = deleteData('gallery_images', 'image_name', $delete_image);
				if ($success) {
					if (file_exists(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$delete_image) && !empty($delete_image)) {
						unlink(UPLOAD_DIR.'/'.$_POST['last_path'].'/'.$delete_image);
					}
				}
			}
		}



		if ($pull_gallery_id_for_other_images) {
		 	$_SESSION['success'] = "Gallery ".$act."ed successfully.";
		} else{
		 	$_SESSION['error'] = "Sorry!  There was problem while " .$act."ing others images.";

		 }
		@header('location: list-gallery');
		exit;





	}else if(isset($_GET, $_GET['id']) && !empty($_GET['id'])){
		$id = (int)$_GET['id'];
		if ($id <=0) {
			$_SESSION['error'] = "Sorry ! Invalid Gallery ID.";
			@header('location: list-gallery');
			exit; 
		}
		$gallery_info = getRowByRowId('galleries', $id);
		 
		if ($gallery_info) {
			$del = deleteData('galleries', 'id', $id);
			 
			if ($del) {
				if (!empty($gallery_info['path']) && file_exists(UPLOAD_DIR.'/'.$gallery_info['path'])) {

					chdir(UPLOAD_DIR.'/'.$gallery_info['path']);
					$all_images = glob("*.*");
					 
					$no_of_images= count($all_images);
					$n = 0;
					foreach ($all_images as $filename) {
						
						unlink(UPLOAD_DIR.'/'.$gallery_info['path'].'/'.$filename);
						$n = $n + 1;
					}
					if ($no_of_images== $n ) {
						rmdir(UPLOAD_DIR.'/'.$gallery_info['path']);
					}
					 
				}
				$_SESSION['success'] = "Gallery Deleted Successfully.";
				@header('location: list-gallery');
				exit;
			} else{
				$_SESSION['error'] = "Sorry ! There was Problem while deleting Gallery.";
				@header('location: list-gallery');
				exit; 
			}
		} else{
			$_SESSION['error'] = "Sorry ! The id You Provided has been already deleted or does not exists.";
			@header('location: list-gallery');
			exit; 
		}
	}else{
		$_SESSION['error'] = "Unauthorized Access.";
		@header('location: list-gallery');
		exit;
	}
	 
?>