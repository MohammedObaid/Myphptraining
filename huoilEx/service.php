<?php

require_once 'Classes/PHPExcel.php';

$filename = 'register.xlsx';

if (file_exists($filename)) {
	$inputFileType = PHPExcel_IOFactory::identify($filename);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($filename);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
if(isset($_GET['Name'])&&isset($_GET['PhoneNumberme'])&&isset($_GET['TruckNumber'])&&isset($_GET['CompanyActivity'])){
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$lastRowNumber=$objPHPExcel->getActiveSheet()->getHighestRow()+1;
$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$lastRowNumber,$_GET['Name'])
			->setCellValue('B'.$lastRowNumber, $_GET['PhoneNumberme'])
			->setCellValue('C'.$lastRowNumber,$_GET['TruckNumber'])
			->setCellValue('D'.$lastRowNumber, $_GET['CompanyActivity'])
		
			;
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($filename);




$lastRow =$objPHPExcel->getActiveSheet()->getHighestRow()+1;
// echo $lastRow;
$message=array();
  array_push($message,array("message"=>"true"));   
echo json_encode($message);
}
else{
	$message=array();
  array_push($message,array("message"=>"false"));   
echo json_encode($message);
	
}

} else {
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getActiveSheet()
			->setCellValue('A1', ' Name')
			->setCellValue('B1', ' Phone Number')
			->setCellValue('C1', ' Truck Number')
			->setCellValue('D1', ' Company Activity')
		;
			$objPHPExcel->getActiveSheet()->setTitle('Chesse1');

   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($filename);
/////////////////////////////////////////////




if(isset($_GET['Name'])&&isset($_GET['PhoneNumberme'])&&isset($_GET['TruckNumber'])&&isset($_GET['CompanyActivity'])){
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$lastRowNumber=$objPHPExcel->getActiveSheet()->getHighestRow()+1;
$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$lastRowNumber,$_GET['Name'])
			->setCellValue('B'.$lastRowNumber, $_GET['PhoneNumberme'])
			->setCellValue('C'.$lastRowNumber,$_GET['TruckNumber'])
			->setCellValue('D'.$lastRowNumber, $_GET['CompanyActivity'])
		
			;
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($filename);




$lastRow =$objPHPExcel->getActiveSheet()->getHighestRow()+1;
// echo $lastRow;
$message=array();
  array_push($message,array("message"=>"true"));   
echo json_encode($message);
}
else{
	$message=array();
  array_push($message,array("message"=>"false"));   
echo json_encode($message);
	
}

















}




// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="helloworld.xlsx"');
// header('Cache-Control: max-age=0');





?>





<!-- require_once 'Classes/PHPExcel.php';

$filename = 'register.xlsx';

if (file_exists($filename)) {
	$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'hello world!');
$objPHPExcel->getActiveSheet()->setTitle('Chesse1');
   $objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel2 = $objReader->load($filename);
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($objPHPExcel);




$lastRow =$objPHPExcel2->getActiveSheet()->getHighestRow();
echo $lastRow;

} else {
		$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'hello world!');
$objPHPExcel->getActiveSheet()->setTitle('Chesse1');
   $objReader = PHPExcel_IOFactory::createReader('Excel2007');
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('register.xlsx');
}




// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="helloworld.xlsx"');
// header('Cache-Control: max-age=0'); -->
