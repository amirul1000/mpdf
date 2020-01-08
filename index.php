<?php
        // get the HTML
		ob_start();
		include(dirname(__FILE__).'/template.php');
		$html = ob_get_clean();
		
		include("mpdf60/mpdf.php");					
		$mpdf=new mPDF('','A4'); 
		
		//$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 
		//$mpdf->mirrorMargins = true;
		
		$mpdf->SetDisplayMode('fullpage');
		//==============================================================
		$mpdf->autoScriptToLang = true;
		$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
		$mpdf->autoVietnamese = true;
		$mpdf->autoArabic = true;
		
		$mpdf->autoLangToFont = true;
		
		$mpdf->setAutoBottomMargin = 'stretch'; 
		
		/* This works almost exactly the same as using autoLangToFont:
			$stylesheet = file_get_contents('../lang2fonts.css');
			$mpdf->WriteHTML($stylesheet,1);
		*/
		$mpdf->SetWatermarkImage('logo.jpg', 0.20, 'F');
		$mpdf->showWatermarkImage = true;
		
		$stylesheet = file_get_contents('mpdf60/lang2fonts.css');
		$mpdf->WriteHTML($stylesheet,1);
		
		$mpdf->WriteHTML($html);
		
		$mpdf->Output("tesr.pdf");
		//$mpdf->Output( $filePath,'S');
		exit;		  

?>