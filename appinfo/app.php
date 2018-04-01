<?php

use OCP\AppFramework\App;
use \OCP\Files\FileInfo;


$app = new App('camerarawpreviews');
$container = $app->getContainer();
$mimeTypeDetector = \OC::$server->getMimeTypeDetector();
$mimeTypeLoader = \OC::$server->getMimeTypeLoader();
// Register custom mimetype we can hook in the frontend
$mimeTypeDetector->getAllMappings();
$mimeTypeDetector->registerType('indd', 'image/x-indesign', 'application/x-indesign');
$mimeTypeDetector->registerType('arw', 'image/x-sony-arw', 'image/x-sony-arw');

$previewManager = $container->getServer()->query('PreviewManager');
$previewManager->registerProvider('/image\/x-dcraw/', function() { return new \OCA\CameraRawPreviews\RawPreview; });
$previewManager->registerProvider('/image\/x-indesign/', function() { return new \OCA\CameraRawPreviews\IndesignPreview; });
$previewManager->registerProvider('/image\/x-sony-arw/', function() { return new \OCA\CameraRawPreviews\RawPreview; });
