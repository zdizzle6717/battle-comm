<?php
//**********************************************
// Advanced HTML Editor 3
// Version: 3.03
//
// (c) 2011 DMXzone.com
//
//**********************************************
?>
<?php require_once('../../../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once('../../../ScriptLibrary/cGraphicMediator.php'); ?>
<?php
// Pure PHP Upload 2.1.3
if (isset($_GET['GP_upload'])) {
	$ppu = new pureFileUpload();
	$ppu->extensions = "GIF,JPG,JPEG,BMP,PNG";
	if (isset($_GET['upfolder'])){
		$basePath = realpath($_GET['upfolder']);
		if (!file_exists($basePath.'/upload_authorize_for_dmxEditor')) {
			echo '<h1>Upload Error</h1><b>This folder is not authorized for upload!</b><br/>Please make sure it has write permissions and the authorization file is in it.';
			die;
		}
		$listUrl = $basePath.'/list_authorize_for_dmxEditor';
		if (file_exists($listUrl)) {
			if (filesize($listUrl) > 0) {
				$listFile = fopen($listUrl, 'rb');
				if ($listFile !== false) {
					$listCont = fread($listFile, filesize($listUrl));
					if ($listCont !== false) {
						$ppu->extensions = $listCont;
					}
					fclose($listFile);
				}
			}
		}
		if (isset($_GET['subfolder'])) {
			$newPath = normalize($basePath."/".$_GET['subfolder']);
			if (strpos($newPath, $basePath) !== 0) {
				echo '<h1>Upload Error</h1>Bad subfolder!';
				die;
			}
			$ppu->path = $_GET['upfolder']."/".$_GET['subfolder'];
		} else {
			$ppu->path = $_GET['upfolder'];
		}
	} else {
		echo '<h1>Upload Error</h1>Bad upload location';
		die;
	}
	$ppu->formName = "form1";
	$ppu->storeType = "file";
	$ppu->sizeLimit = "";
	$ppu->nameConflict = "uniq";
	$ppu->requireUpload = "false";
	$ppu->minWidth = "";
	$ppu->minHeight = "";
	$ppu->maxWidth = "";
	$ppu->maxHeight = "";
	$ppu->saveWidth = "width";
	$ppu->saveHeight = "height";
	$ppu->timeout = "600";
	$ppu->progressBar = "";
	$ppu->progressWidth = "300";
	$ppu->progressHeight = "100";
	$ppu->checkVersion("2.1.3");
	$ppu->doUpload();
}

// Smart Image Processor PHP 2.0.2
if (isset($_GET['GP_upload'])) {
	$sipp2 = new cGraphicMediator("upload", $ppu, "");
	$sipp2->setComponent("Auto");
	if (isset($_GET["crop"]) && method_exists($sipp2, 'resizeEx')) {
		$sipp2->resizeEx($_GET["mw"], $_GET["mh"], true, true);
	} else {
		$sipp2->resize($_GET["mw"], $_GET["mh"], true);
	}
	$sipp2->overwrite = true;
	$sipp2->nSaveJpegQuality = 95;
	$sipp2->save();
	$sipp2->process();

	echo "Upload Succesful@@@filename=".$_POST["file"]."@@@height=".$sipp2->rImageEditor->getHeight()."@@@width=".$sipp2->rImageEditor->getWidth()."@@@End Upload info";
	die;
}

function normalize($path) {
	$path = str_replace('\\', '/', $path);
	$path = array_reduce(explode('/', $path), create_function('$a, $b', '
		if($a === 0)
			$a = "";
			else $a = $a."/";

		if($b === "" || $b === ".")
			return $a;

		if($b === "..")
			return dirname($a);
		return preg_replace("/\/+/", "/", "$a$b");
	'), 0);
	return str_replace('/', DIRECTORY_SEPARATOR, $path);
}

?>