<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    public function __construct()
	{
            date_default_timezone_set('Asia/Manila');
            parent::__construct();
            $this->load->model('Report_management_model','rmm');
			$this->load->library('Excel');
			$this->load->library('CI_tcpdf');
			$this->load->library('CI_fpdf');
    }

    public function index(){
		if ($this->session->userdata('employee_code')) {
			$header['title_page'] = "Generate Built-in Reports";
			$data[] = "";
			$usertype = $this->session->userdata('usertype');
			if($usertype == 'Administrator'){
				$this->load->view('admin/fragments/admin_header',$header);
				$this->load->view('admin/fragments/admin_navbar');
				$this->load->view('admin/admin_report',$data);
				$this->load->view('admin/fragments/admin_r_sidebar');
				$this->load->view('admin/fragments/admin_footer.php');
			}else{
				$this->load->view('hr_payroll/fragments/payroll_header',$header);
				$this->load->view('hr_payroll/fragments/payroll_navbar');
				$this->load->view('hr_payroll/payroll_report',$data);
				$this->load->view('hr_payroll/fragments/payroll_r_sidebar');
				$this->load->view('hr_payroll/fragments/payroll_footer.php');
			}
		} else {
			Redirect(base_url('HRMISystem'));
		}
    }

    public function report_customized_redirect(){
		if ($this->session->userdata('employee_code')) {
			$this->load->model('Section_management_model','smm');
			$header['title_page'] = "Generate Customize Reports";
			$data['section'] = $this->smm->get_active_section();
			$usertype = $this->session->userdata('usertype');
			if($usertype == 'Administrator'){
				$this->load->view('admin/fragments/admin_header',$header);
				$this->load->view('admin/fragments/admin_navbar');
				$this->load->view('admin/admin_report_custom',$data);
				$this->load->view('admin/fragments/admin_r_sidebar');
				$this->load->view('admin/fragments/admin_footer.php');
			}else{
				$this->load->view('hr_payroll/fragments/payroll_header',$header);
				$this->load->view('hr_payroll/fragments/payroll_navbar');
				$this->load->view('hr_payroll/payroll_report_custom',$data);
				$this->load->view('hr_payroll/fragments/payroll_r_sidebar');
				$this->load->view('hr_payroll/fragments/payroll_footer.php');
			}
		} else {
			Redirect(base_url('HRMISystem'));
		}
    }

    public function generate_employee_masterlist(){
            //activate worksheet number 1
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			// set Header
			$headerText = new PHPExcel_RichText();
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setTop(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setRight(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setLeft(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setBottom(0.25);

			$columns = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y');
				foreach($columns as $colRow) {
					foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
						$objPHPExcel->getActiveSheet()
								->getColumnDimension($col)
								->setAutoSize(true);
					}
				}
			$countCol = 1;
			foreach($columns as $colRow) {
				$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			}
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NAME');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'DATE OF BIRTH');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'BIRTHPLACE');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'AGE');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MOBILE NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'TELEPHONE NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'EMAIL');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'SEX');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'PRESENT ADDRESS');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'PERMANENT ADDRESS');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'CIVILSTATUS');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'SECTION');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'POSITION');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'EMPLOYMENT STATUS');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'DATE HIRED');
            $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'YRS OF SERVICE');
			$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'TIN');
			$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'SSS');
			$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'PHIC');
            $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'HDMF');
			$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'CTC');
			$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'DATE ISSUED');
			$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'LICENSE NO');
			$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'EXPIRATION DATE');
            $empInfo = $this->rmm->export_employee_masterlist();
			$rowCount = 2;
			foreach ($empInfo as $element) {
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['birthdate']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['bplace']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['age']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['mob_no']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['tel_no']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['email']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['sex']);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['prese_add']);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['perma_add']);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['civil_stat']);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['section']);
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['position']);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element['emp_status']);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element['date_hired']);
				$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element['yrs_service']);
                $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $element['TIN']);
                $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $element['SSS']);
                $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $element['PHIC']);
                $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $element['HDMF']);
                $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $element['CTC_no']);
                $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $element['Date_Issued']);
                $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $element['License_no']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $element['exp_date']);
				$rowCount++;
            }
			$filename = "Report Employee Masterlist.xls";
			$this->excel->getActiveSheet()->setTitle('Employee Masterlist');
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');
			// die();
	}
	
	public function generate_emp_designation(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E','F');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'SECTION');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'POSITION');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'EMPLOYMENT STATUS');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'DATE HIRED');
		$empInfo = $this->rmm->export_employee_masterlist();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['section']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['position']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['emp_status']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['date_hired']);
			$rowCount++;
		}
		$filename = "Report Employee Designation.xls";
		$this->excel->getActiveSheet()->setTitle('Employee Masterlist');
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function generate_employee_ids(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E','F','G','H','I','J');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'TIN');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'SSS');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'PHIC');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'HDMF');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'CTC');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'DATE ISSUED');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'LICENSE NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'EXPIRATION DATE');
		$empInfo = $this->rmm->export_employee_ids();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['TIN']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['SSS']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['PHIC']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['HDMF']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['CTC_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['Date_Issued']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['License_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['exp_date']);
			$rowCount++;
		}
		$objPHPExcel->getActiveSheet()->setTitle("Employee IDs");

		// set Header
		$objWorkSheet = $objPHPExcel->createSheet(1);
		$headerText = new PHPExcel_RichText();
		$objWorkSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objWorkSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objWorkSheet
			->getPageMargins()->setTop(0.25);
		$objWorkSheet
			->getPageMargins()->setRight(0.25);
		$objWorkSheet
			->getPageMargins()->setLeft(0.25);
		$objWorkSheet
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E','F','G','H','I','J');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objWorkSheet->getHighestDataColumn()) as $col) {
					$objWorkSheet
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objWorkSheet->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objWorkSheet->SetCellValue('A1', 'ID NO');
		$objWorkSheet->SetCellValue('B1', 'NAME');
		$objWorkSheet->SetCellValue('C1', 'TIN');
		$objWorkSheet->SetCellValue('D1', 'SSS');
		$objWorkSheet->SetCellValue('E1', 'PHIC');
		$objWorkSheet->SetCellValue('F1', 'HDMF');
		$objWorkSheet->SetCellValue('G1', 'CTC');
		$objWorkSheet->SetCellValue('H1', 'DATE ISSUED');
		$objWorkSheet->SetCellValue('I1', 'LICENSE NO');
		$objWorkSheet->SetCellValue('J1', 'EXPIRATION DATE');
		$empInfo = $this->rmm->export_employee_ids();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objWorkSheet->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $element['TIN_format']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $element['SSS_format']);
			$objWorkSheet->SetCellValue('E' . $rowCount, $element['PHIC_format']);
			$objWorkSheet->SetCellValue('F' . $rowCount, $element['HDMF_format']);
			$objWorkSheet->SetCellValue('G' . $rowCount, $element['CTC_no']);
			$objWorkSheet->SetCellValue('H' . $rowCount, $element['Date_Issued']);
			$objWorkSheet->SetCellValue('I' . $rowCount, $element['License_no']);
			$objWorkSheet->SetCellValue('J' . $rowCount, $element['exp_date']);
			$rowCount++;
		}
		$objWorkSheet->setTitle("Employee IDs - Formatted");
		$filename = "Report Employee IDs.xls";
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function generate_birthday_celebrant(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'DATE OF BIRTH');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'AGE');
		$empInfo = $this->rmm->export_birthday_celebrants();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['birthdate']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['age']);
			$rowCount++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Employee Birthday Celebrants');
		$filename = "Report Birthday Celebrants - ".date('m').".xls";
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function generate_section_department_heads(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DEPARTMENT');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'SECTION');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'HEAD');
		$empInfo = $this->rmm->export_section_heads();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['department']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['section']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['head']);
			$rowCount++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('SECTION');
		// set Header
		$objWorkSheet = $objPHPExcel->createSheet(1);
		$headerText = new PHPExcel_RichText();
		$objWorkSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objWorkSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objWorkSheet
			->getPageMargins()->setTop(0.25);
		$objWorkSheet
			->getPageMargins()->setRight(0.25);
		$objWorkSheet
			->getPageMargins()->setLeft(0.25);
		$objWorkSheet
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E','F','G','H','I','J');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objWorkSheet->getHighestDataColumn()) as $col) {
					$objWorkSheet
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objWorkSheet->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objWorkSheet->SetCellValue('A1', 'DEPARTMENT');
		$objWorkSheet->SetCellValue('B1', 'NAME');
		$empInfo = $this->rmm->export_department_heads();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objWorkSheet->SetCellValue('A' . $rowCount, $element['department']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $element['head']);
			$rowCount++;
		}
		$objWorkSheet->setTitle("DEPARTMENT");
		$filename = "Report Section-Department Heads as of - ".date('F d,Y').".xls";
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function generate_employee_directory(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'MOBILE NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'TELEPHONE NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'EMAIL');
		$empInfo = $this->rmm->export_employee_directory();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['mob_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['tel_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['email']);
			$rowCount++;
		}
		$filename = "Report Employee Directory.xls";
		$objPHPExcel->getActiveSheet()->setTitle('Employee Directory');
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function generate_employee_dependents(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'NAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'No of Dependents');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Dependent Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Dependent Birthday');
		$empInfo = $this->rmm->export_employee_dependents();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['no_deps']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['dep_Name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['dep_Bdate']);
			$rowCount++;
		}
		$filename = "Report Employee Dependents.xls";
		$objPHPExcel->getActiveSheet()->setTitle('Employee Dependents');
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function generate_age_distribution(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Age Range');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Male');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Female');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Total');
		$empInfo = $this->rmm->export_age_distribution();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['age_range']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['male']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['female']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['total']);
			$rowCount++;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Age Distribution');

		$objWorkSheet = $objPHPExcel->createSheet(1);
		$headerText = new PHPExcel_RichText();
		$objWorkSheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objWorkSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objWorkSheet
			->getPageMargins()->setTop(0.25);
		$objWorkSheet
			->getPageMargins()->setRight(0.25);
		$objWorkSheet
			->getPageMargins()->setLeft(0.25);
		$objWorkSheet
			->getPageMargins()->setBottom(0.25);
		$columns = array('A','B','C','D');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objWorkSheet->getHighestDataColumn()) as $col) {
					$objWorkSheet->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objWorkSheet->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		
		$result = $this->rmm->export_age_distribution_detailed();
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'bold'		=> true,
				'size'		=> 12,
			)
		);
		$objWorkSheet->SetCellValue('A1', 'NAME');
		$objWorkSheet->SetCellValue('B1', 'BIRTHDATE');
		$objWorkSheet->SetCellValue('C1', 'AGE');
		$objWorkSheet->SetCellValue('D1', 'SEX');
		$objWorkSheet->mergeCells('A2:D2');
		$objWorkSheet->setCellValue('A2','Age group 18 to 20');
		$objWorkSheet->getStyle("A2:D2")->applyFromArray($style);
		$rowCount = 3;
		foreach($result['18to20'] as $bracket1820){
			$objWorkSheet->SetCellValue('A' . $rowCount, $bracket1820['Name']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $bracket1820['birthdate']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $bracket1820['age']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $bracket1820['sex']);
			$rowCount++;
		}
		$objWorkSheet->mergeCells('A' . $rowCount.':D' . $rowCount);
		$objWorkSheet->setCellValue('A'.$rowCount,'Age group 21 to 30');
		$objWorkSheet->getStyle('A' . $rowCount.':D' . $rowCount)->applyFromArray($style);
		$rowCount = $rowCount +1;
		foreach($result['21to30'] as $bracket2130){
			$objWorkSheet->SetCellValue('A' . $rowCount, $bracket2130['Name']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $bracket2130['birthdate']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $bracket2130['age']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $bracket2130['sex']);
			$rowCount++;
		}
		$objWorkSheet->mergeCells('A' . $rowCount.':D' . $rowCount);
		$objWorkSheet->setCellValue('A'.$rowCount,'Age group 31 to 40');
		$objWorkSheet->getStyle('A' . $rowCount.':D' . $rowCount)->applyFromArray($style);
		$rowCount = $rowCount +1;
		foreach($result['31to40'] as $bracket3140){
			$objWorkSheet->SetCellValue('A' . $rowCount, $bracket3140['Name']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $bracket3140['birthdate']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $bracket3140['age']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $bracket3140['sex']);
			$rowCount++;
		}
		$objWorkSheet->mergeCells('A' . $rowCount.':D' . $rowCount);
		$objWorkSheet->setCellValue('A'.$rowCount,'Age group 41 to 50');
		$objWorkSheet->getStyle('A' . $rowCount.':D' . $rowCount)->applyFromArray($style);
		$rowCount = $rowCount +1;
		foreach($result['41to50'] as $bracket4150){
			$objWorkSheet->SetCellValue('A' . $rowCount, $bracket4150['Name']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $bracket4150['birthdate']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $bracket4150['age']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $bracket4150['sex']);
			$rowCount++;
		}
		$objWorkSheet->mergeCells('A' . $rowCount.':D' . $rowCount);
		$objWorkSheet->setCellValue('A'.$rowCount,'Age group 51 to 60');
		$objWorkSheet->getStyle('A' . $rowCount.':D' . $rowCount)->applyFromArray($style);
		$rowCount = $rowCount +1;
		foreach($result['51to60'] as $bracket5160){
			$objWorkSheet->SetCellValue('A' . $rowCount, $bracket5160['Name']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $bracket5160['birthdate']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $bracket5160['age']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $bracket5160['sex']);
			$rowCount++;
		}
		$objWorkSheet->mergeCells('A' . $rowCount.':D' . $rowCount);
		$objWorkSheet->setCellValue('A'.$rowCount,'Age group 61 and Above');
		$objWorkSheet->getStyle('A' . $rowCount.':D' . $rowCount)->applyFromArray($style);
		$rowCount = $rowCount +1;
		foreach($result['60up'] as $bracket60up){
			$objWorkSheet->SetCellValue('A' . $rowCount, $bracket60up['Name']);
			$objWorkSheet->SetCellValue('B' . $rowCount, $bracket60up['birthdate']);
			$objWorkSheet->SetCellValue('C' . $rowCount, $bracket60up['age']);
			$objWorkSheet->SetCellValue('D' . $rowCount, $bracket60up['sex']);
			$rowCount++;
		}
		$objWorkSheet->setTitle('Age Distribution Detailed');
		$filename = "Report Employee Age Distribution.xls";
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}
	public function generate_count_section()
	{
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SECTION');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'No of Employees');
		$empInfo = $this->rmm->export_count_by_section();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['section_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_count']);
			$rowCount++;
		}
		$filename = "Report Employee Count - Section.xls";
		$objPHPExcel->getActiveSheet()->setTitle('Age Distribution');
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}

	public function view_all_employee_dtr(){
		$header['title_page'] = "Employee Attendance";
		$data['dtr_record'] = $this->rmm->extract_dtr_record_prev_month();
			$this->load->view('admin/fragments/admin_header',$header);
			$this->load->view('admin/fragments/admin_navbar');
			$this->load->view('reports/dtr_report.php',$data);
			$this->load->view('admin/fragments/admin_r_sidebar');
			$this->load->view('admin/fragments/admin_footer.php');
		
	}
	
	public function generate_employee_dtr1(){
		//activate worksheet number 1
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);

		$columns = array('A','B','C','D','E');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);;
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DATE');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'IN');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'OUT');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'IN');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'OUT');
		$empInfo = $this->rmm->extract_dtr_record_prev_month();
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['Att_Date']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['Att_TimeIn']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['Att_TimeOut']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['Att_TimeMisc']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['Att_TimeMisc1']);
			$rowCount++;
		}
		$styleArray = array(
			'font' => array(
				'bold' => true,
				'color' => array('rgb' => '2F4F4F')
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		);
		$last_row = 'E'.$rowCount;
		$objPHPExcel->getActiveSheet()->getStyle("A1:".$last_row."")->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle("A2:".$last_row."")->getFont()->setSize(10);
		// $objPHPExcel->getActiveSheet()->getStyle('A:E')->applyFromArray($styleArray);
		$filename = "Report DTR - ".date('F Y').".xls";
		$objPHPExcel->getActiveSheet()->setTitle(date('F Y'));
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
		// die();
	}
	public function generate_employee_dtr_previous_pdf(){
		$pdf = new CI_fpdf();
		$dtr_record = $this->rmm->extract_dtr_record_prev_month();
		$records = count($dtr_record)-1;
		$days = cal_days_in_month(CAL_GREGORIAN,date('m',strtotime("-1 month")),date('Y'));
		// $days = 29;
		for($rep=0;$rep<=$records;$rep++){
			// HEADER
			$pdf->AliasNbPages();
			$pdf->AddPage('P',array(375,225));
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(10,5);
			$pdf->Cell(0,10,'ID No.');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(20,5);
			$pdf->Cell(0,10,$dtr_record[$rep]['employee_code']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(34,5);
			$pdf->Cell(20,10,'Name:');
			$pdf->SetXY(45,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(10,10,$dtr_record[$rep]['emp_wname']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(106.5,5);
			$pdf->Cell(20,10,'Section:');
			$pdf->SetXY(120,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['section']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(185,5);
			$pdf->Cell(70,10,'Status:');
			$pdf->SetXY(197,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['status']);
			// 
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(10,17);
			$pdf->Cell(0,0,'DATE');
			$pdf->SetXY(62,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(90,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(122,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(150,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(178,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(206,17);
			$pdf->Cell(0,0,'OUT');
			
			// DTR TABLE
			$CellY = 22;
			for($row=0;$row<$days;$row++){
				$pdf->SetFont('Arial','',10);
				// $pdf->SetXY(10,35);
				$pdf->SetXY(10,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_Date']);
				// $pdf->SetXY(50,35);
				$pdf->SetXY(55,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeIn']);
				// $pdf->SetXY(95,35);
				$pdf->SetXY(85,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeOut']);
				// $pdf->SetXY(135,35);
				$pdf->SetXY(115,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc']);
				// $pdf->SetXY(175,35);
				$pdf->SetXY(145,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc1']);
			$CellY = $CellY +3.75;
			}
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',7);
			$pdf->Line(140,130,187.5,130);
			$pdf->SetLineWidth(0.1);
			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(142,132);
			$pdf->Cell(0,0,'SIGNATURE OVER PRINTED NAME');
			$pdf->SetXY(130,135);
			$pdf->Cell(0,0,'This is to certify that these records are true and correct');
		}
		$filename = "HRMIS_DTR_REPORT_for_the_month_of_". date('F_Y',strtotime("-1 month"));
		$pdf->Output('./files/dtr_reports/' . $filename . '.pdf', 'F');
		$pdf->Output();
	}

	public function generate_employee_dtr_current_pdf(){
		$pdf = new CI_fpdf();
		$dtr_record = $this->rmm->extract_dtr_record_current_month();
		$records = count($dtr_record)-1;
		$days = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
		if($days > date('d')){
			$days_count = intval(date('d'));
		}else{
			$days_count = $days;
		}
		for($rep=0;$rep<=$records;$rep++){
			// HEADER
			// HEADER
			$pdf->AliasNbPages();
			$pdf->AddPage('P',array(375,225));
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(10,5);
			$pdf->Cell(0,10,'ID No.');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(20,5);
			$pdf->Cell(0,10,$dtr_record[$rep]['employee_code']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(34,5);
			$pdf->Cell(20,10,'Name:');
			$pdf->SetXY(45,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(10,10,$dtr_record[$rep]['emp_wname']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(106.5,5);
			$pdf->Cell(20,10,'Section:');
			$pdf->SetXY(120,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['section']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(185,5);
			$pdf->Cell(70,10,'Status:');
			$pdf->SetXY(197,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['status']);
			// 
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(10,17);
			$pdf->Cell(0,0,'DATE');
			$pdf->SetXY(62,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(90,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(122,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(150,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(178,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(206,17);
			$pdf->Cell(0,0,'OUT');
			
			// DTR TABLE
			$CellY = 22;
			for($row=0;$row<$days_count;$row++){
				$pdf->SetFont('Arial','',10);
				// $pdf->SetXY(10,35);
				$pdf->SetXY(10,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_Date']);
				// $pdf->SetXY(50,35);
				$pdf->SetXY(55,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeIn']);
				// $pdf->SetXY(95,35);
				$pdf->SetXY(85,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeOut']);
				// $pdf->SetXY(135,35);
				$pdf->SetXY(115,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc']);
				// $pdf->SetXY(175,35);
				$pdf->SetXY(145,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc1']);
			$CellY = $CellY +3.75;
			}
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',7);
			$pdf->Line(140,130,187.5,130);
			$pdf->SetLineWidth(0.1);
			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(142,132);
			$pdf->Cell(0,0,'SIGNATURE OVER PRINTED NAME');
			$pdf->SetXY(130,135);
			$pdf->Cell(0,0,'This is to certify that these records are true and correct');
		}
		$pdf->Output();
		$filename = "HRMIS_DTR_REPORT_for_the_month_of_". date('F_Y');
		$pdf->Output('./files/dtr_reports/' . $filename . '.pdf', 'F');
	}

	public function generate_contractual_employee_dtr_1to5(){
		$pdf = new CI_fpdf();
		$dtr_record = $this->rmm->extract_dtr_record_current_month_for_contractual();
		$records = count($dtr_record);
		$days = 5;
		for($rep=0;$rep<$records;$rep++){
			$pdf->AliasNbPages();
			$pdf->AddPage('L', 'Letter');
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(10,5);
			$pdf->Cell(0,10,'ID No.');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(20,5);
			$pdf->Cell(0,10,$dtr_record[$rep]['employee_code']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(34,5);
			$pdf->Cell(20,10,'Name:');
			$pdf->SetXY(45,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(10,10,$dtr_record[$rep]['emp_wname']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(106.5,5);
			$pdf->Cell(20,10,'Section:');
			$pdf->SetXY(120,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['section']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(185,5);
			$pdf->Cell(70,10,'Status:');
			$pdf->SetXY(197,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['status']);
			// 
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(10,17);
			$pdf->Cell(0,0,'DATE');
			$pdf->SetXY(47,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(75,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(107,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(135,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(163,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(191,17);
			$pdf->Cell(0,0,'OUT');
			// DTR TABLE
			$CellY = 22;
			for($row=0;$row<$days;$row++){
				$pdf->SetFont('Arial','',10);
				// $pdf->SetXY(10,35);
				$pdf->SetXY(10,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_Date']);
				// $pdf->SetXY(50,35);
				$pdf->SetXY(40,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeIn']);
				// $pdf->SetXY(95,35);
				$pdf->SetXY(70,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeOut']);
				// $pdf->SetXY(135,35);
				$pdf->SetXY(100,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc']);
				// $pdf->SetXY(175,35);
				$pdf->SetXY(130,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc1']);
				$CellY = $CellY +3.75;
			}
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',7);
			$pdf->Line(140,130,187.5,130);
			$pdf->SetLineWidth(0.1);
			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(142,132);
			$pdf->Cell(0,0,'SIGNATURE OVER PRINTED NAME');
			$pdf->SetXY(130,135);
			$pdf->Cell(0,0,'This is to certify that these records are true and correct');
		}
		$pdf->Output();
		// $filename = "HRMIS_DTR_REPORT_for_the_month_of_". date('F_Y');
		// $pdf->Output('./files/dtr_reports/' . $filename . '.pdf', 'F');
	}
	public function generate_contractual_employee_dtr_6to20(){
		$pdf = new CI_fpdf();
		$dtr_record = $this->rmm->extract_dtr_record_current_month_for_contractual_620();
		$records = count($dtr_record);
		$days = 20;
		for($rep=0;$rep<$records;$rep++){
			$pdf->AliasNbPages();
			$pdf->AddPage('L', 'Letter');
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(10,5);
			$pdf->Cell(0,10,'ID No.');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(20,5);
			$pdf->Cell(0,10,$dtr_record[$rep]['employee_code']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(34,5);
			$pdf->Cell(20,10,'Name:');
			$pdf->SetXY(45,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(10,10,$dtr_record[$rep]['emp_wname']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(106.5,5);
			$pdf->Cell(20,10,'Section:');
			$pdf->SetXY(120,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['section']);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(185,5);
			$pdf->Cell(70,10,'Status:');
			$pdf->SetXY(197,5);
			$pdf->SetFont('Arial','',9); 
			$pdf->Cell(30,10,$dtr_record[$rep]['status']);
			// 
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(10,17);
			$pdf->Cell(0,0,'DATE');
			$pdf->SetXY(47,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(75,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(107,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(135,17);
			$pdf->Cell(0,0,'OUT');
			$pdf->SetXY(163,17);
			$pdf->Cell(0,0,'IN');
			$pdf->SetXY(191,17);
			$pdf->Cell(0,0,'OUT');
			// DTR TABLE
			$CellY = 22;
			for($row=5;$row<$days;$row++){
				$pdf->SetFont('Arial','',10);
				// $pdf->SetXY(10,35);
				$pdf->SetXY(10,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_Date']);
				// $pdf->SetXY(50,35);
				$pdf->SetXY(40,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeIn']);
				// $pdf->SetXY(95,35);
				$pdf->SetXY(70,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeOut']);
				// $pdf->SetXY(135,35);
				$pdf->SetXY(100,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc']);
				// $pdf->SetXY(175,35);
				$pdf->SetXY(130,$CellY);
				$pdf->Cell(0,0,$dtr_record[$rep][$row]['Att_TimeMisc1']);
				$CellY = $CellY +3.75;
			}
			// DTR TABLE HEADER
			$pdf->SetFont('Arial','B',7);
			$pdf->Line(140,130,187.5,130);
			$pdf->SetLineWidth(0.1);
			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(142,132);
			$pdf->Cell(0,0,'SIGNATURE OVER PRINTED NAME');
			$pdf->SetXY(130,135);
			$pdf->Cell(0,0,'This is to certify that these records are true and correct');
		}
		$pdf->Output();
		// $filename = "HRMIS_DTR_REPORT_for_the_month_of_". date('F_Y');
		// $pdf->Output('./files/dtr_reports/' . $filename . '.pdf', 'F');
	}
	public function generate_leave_request_prev_month(){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);
		$columns = array('A','B','C','D','E');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);;
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date Filed');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Leave Type');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Inclusive Dates');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Status');
		$leave_request = $this->rmm->get_all_leave_request_prev_month();
		$rowCount = 2;
		foreach ($leave_request as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['date_filed']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['leave_type']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['inclusive_date']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['status']);
			$rowCount++;
		}
		$filename = "Report Leave Request.xls";
		$objPHPExcel->getActiveSheet()->setTitle(date('F Y'));
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
	public function generate_leave_request_prev_month_summary(){
		$pdf = new CI_fpdf();
		$approved_leave = $this->rmm->get_all_leave_request_prev_month_summary();
		$records = count($approved_leave);
		for($rep=0;$rep<$records;$rep++){
			$pdf->AliasNbPages();
			$pdf->AddPage('P', 'Letter');
			$pdf->SetFont('Arial','I',11);
			$pdf->SetXY(225,5);
			$pdf->Cell(0,0,date('F Y',strtotime('-1 month')));
			$pdf->Image('assets/img/bethany_official/logo.png',100,2,-100,'PNG');
			$pdf->SetFont('Arial','B',12);
			$pdf->SetXY(90,24);
			$pdf->Cell(0,0,'Bethany Hospital Inc.');
			$pdf->SetFont('Arial','I',10);
			$pdf->SetXY(70,30);
			$pdf->Cell(0,0,'Widdoes St., Brgy. II, City of San Fernando, La Union');
			$pdf->SetFont('Arial','B',12);
			$pdf->SetXY(90,40);
			$pdf->Cell(0,0,'APPROVED LEAVES');
			// end of bhi header
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(10,45);
			$pdf->Cell(20,10,'ID No:');
			$pdf->SetFont('Arial','',10); 
			$pdf->SetXY(25,45);
			$pdf->Cell(10,10,$approved_leave[$rep]['employee_code']);
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(45,45);
			$pdf->Cell(20,10,'Name:');
			$pdf->SetFont('Arial','',10); 
			$pdf->SetXY(60,45);
			$pdf->Cell(10,10,$approved_leave[$rep]['emp_wname']);
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(135,45);
			$pdf->Cell(20,10,'Section:');
			$pdf->SetXY(150,45);
			$pdf->SetFont('Arial','',10); 
			$pdf->Cell(10,10,$approved_leave[$rep]['section']);
			//table headers
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(10,55);
			$pdf->Cell(20,10,'Leave Type:');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(52,55);
			$pdf->Cell(20,10,'Date Filed:');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(95,55);
			$pdf->Cell(20,10,'Inclusive Date:');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(170,55);
			$pdf->Cell(20,10,'Leave Credit Used:');
			$pdf->SetFont('Arial','B',10);
			$leave_request = count($approved_leave[$rep])-3;
			$CellY = 65;
			for($row=0;$row<$leave_request;$row++){
				$pdf->SetFont('Arial','',10);
				// $pdf->SetXY(10,35);
				$pdf->SetXY(10,$CellY);
				$pdf->Cell(0,0,$approved_leave[$rep][$row]['leave_type']);
				// $pdf->SetXY(50,35);
				$pdf->SetXY(50,$CellY);
				$pdf->Cell(0,0,$approved_leave[$rep][$row]['date_filed']);
				// $pdf->SetXY(95,35);
				$pdf->SetXY(85,$CellY);
				$pdf->Cell(0,0,$approved_leave[$rep][$row]['inclusive_date']);
				// $pdf->SetXY(135,35);
				$pdf->SetXY(180,$CellY);
				$pdf->Cell(0,0,$approved_leave[$rep][$row]['credit_used']);
				// $pdf->SetXY(135,35);
				$CellY = $CellY + 7.5;
			}
		}
		$pdf->Output();
	}

	public function generate_leave_tally_annual(){
		$tally = $this->rmm->get_leave_tally_monthly();
		var_dump($tally);
	}

	



























	///////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////CUSTOM REPORT GENERATION FUNCTION BELOW///////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	public function generate_customized_report(){
		$custom = $this->input->post('custom_data[]');
		$emp_status = $this->input->post('report_emp_status');
		$section = $this->input->post('report_emp_section');
		$report_title = $this->input->post('report_title');
		$data = "";
		$req_fields = array();
		$header = array('ID No.','Name');
		if(is_array($custom) && count($custom) > 0){
			for($i=0;$i<count($custom);$i++){
				if($custom[$i]=='rep_mobile_no'){
					$data = $data.",emp.emp_mobno as emp_mobno";
					$data1 = 'Mobile No.';
					array_push($header, $data1);
					$field = 'emp_mobno';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_telephone_no'){
					$data = $data.",emp.emp_telno as emp_telno";
					$data1 = 'Telephone No.';
					array_push($header, $data1);
					$field = 'emp_telno';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_email_address'){
					$data = $data.",emp.emp_email as emp_email";
					$data1 = 'Email Address.';
					array_push($header, $data1);
					$field = 'emp_email';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_birthdate'){
					$data = $data.",emp.emp_birthdate as emp_birthdate";
					$data1 = 'Birthdate';
					array_push($header, $data1);
					$field = 'emp_birthdate';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_TIN'){
					$data = $data.",ids.TIN_ID as TIN_ID";
					$data1 = 'TIN';
					array_push($header, $data1);
					$field = 'TIN_ID';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_position'){
					$data = $data.",rec.record_position as record_position";
					$data1 = 'Position';
					array_push($header, $data1);
					$field = 'record_position';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_prese_address'){
					$data = $data.",CONCAT(emp.emp_prese_street,' ',emp.emp_prese_brgy,' ',emp.emp_prese_town,' ',emp.emp_prese_province,' ',emp.emp_prese_region) as emp_present_address";
					$data1 = 'Present Address.';
					array_push($header, $data1);
					$field = 'emp_present_address';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_SSS'){
					$data = $data.",ids.SSS_ID as SSS_ID";
					$data1 = 'SSS.';
					array_push($header, $data1);
					$field = 'SSS_ID';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_section'){
					$data = $data.",rec.record_section as record_section";
					$data1 = 'Section';
					array_push($header, $data1);
					$field = 'record_section';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_perma_address'){
					$data = $data.",CONCAT(emp.emp_perma_street,' ',emp.emp_perma_brgy,' ',emp.emp_perma_town,' ',emp.emp_perma_province,' ',emp.emp_perma_region) as emp_permanent_address";
					$data1 = 'Permanent Address';
					array_push($header, $data1);
					$field = 'emp_permanent_address';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_PhilHealth'){
					$data = $data.",ids.PHIC_ID as PHIC_ID";
					$data1 = 'Philhealth';
					array_push($header, $data1);
					$field = 'PHIC_ID';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_PAGIBIG'){
					$data = $data.",ids.HDMF_ID as HDMF_ID";
					$data1 = 'Pag-IBIG';
					array_push($header, $data1);
					$field = 'HDMF_ID';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_employment_type'){
					$data = $data.",rec.record_status as record_status";
					$data1 = 'Employment Type';
					array_push($header, $data1);
					$field = 'record_status';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_sex'){
					$data = $data.",emp.emp_gender as emp_gender";
					$data1 = 'Gender';
					array_push($header, $data1);
					$field = 'emp_gender';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_CTC'){
					$data = $data.",ids.CTC_No as CTC_No";
					$data1 = 'CTC';
					array_push($header, $data1);
					$field = 'CTC_No';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_civilstat'){
					$data = $data.",emp.emp_civilstatus as emp_civilstatus";
					$data1 = 'Civil Status';
					array_push($header, $data1);
					$field = 'emp_civilstatus';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_PRC'){
					$data = $data.",ids.PRC_License as PRC_License";
					$data1 = 'License No.';
					array_push($header, $data1);
					$field = 'PRC_License';
					array_push($req_fields, $field);
				}elseif($custom[$i]=='rep_date_hired'){
					$data = $data.",rec.record_startdate as record_startdate";
					$data1 = 'Date Hired';
					array_push($header, $data1);
					$field = 'record_startdate';
					array_push($req_fields, $field);
				}
			}
		}else{
			$data = "";
		}
		$result = $this->rmm->generate_custom_report($data,$emp_status,$section);
		$rows = count($result);
		$return_value = array();
		for($i=0;$i<$rows;$i++){
			if($emp_status == 'All' && $section !='All' && $section!=NULL){
				if ((is_array(unserialize(base64_decode($result[$i]['record_section']))) && count(unserialize(base64_decode($result[$i]['record_section']))) > 0 && unserialize(base64_decode($result[$i]['record_section']))[0] != '')) {
					$sec_count = (count(unserialize(base64_decode($result[$i]['record_section'])))) -1;
					$section_emp =  unserialize(base64_decode($result[$i]['record_section']))[$sec_count];
				}else{
					$section_emp =  'Unassigned';
				}
				if($section == $section_emp){
					$crossmatched = array($result[$i]);
					array_push($return_value, $crossmatched);
				}
			}elseif($emp_status != 'All' && $section == 'All'){
				if ((is_array(unserialize(base64_decode($result[$i]['record_status']))) && count(unserialize(base64_decode($result[$i]['record_status']))) > 0 && unserialize(base64_decode($result[$i]['record_status']))[0] != '')) {
					$stat_count = (count(unserialize(base64_decode($result[$i]['record_status'])))) -1;
					$status =  unserialize(base64_decode($result[$i]['record_status']))[$stat_count];
				}else{
					$status =  'Unassigned';
				}
				if($emp_status == $status){
					$crossmatched = array($result[$i]);
					array_push($return_value, $crossmatched);
				}
			}elseif($emp_status != 'All' && $section != 'All'){
				if ((is_array(unserialize(base64_decode($result[$i]['record_section']))) && count(unserialize(base64_decode($result[$i]['record_section']))) > 0 && unserialize(base64_decode($result[$i]['record_section']))[0] != '')) {
					$sec_count = (count(unserialize(base64_decode($result[$i]['record_section'])))) -1;
					$section_emp =  unserialize(base64_decode($result[$i]['record_section']))[$sec_count];
				}else{
					$section_emp =  'Unassigned';
				}
				if ((is_array(unserialize(base64_decode($result[$i]['record_status']))) && count(unserialize(base64_decode($result[$i]['record_status']))) > 0 && unserialize(base64_decode($result[$i]['record_status']))[0] != '')) {
					$stat_count = (count(unserialize(base64_decode($result[$i]['record_status'])))) -1;
					$status =  unserialize(base64_decode($result[$i]['record_status']))[$stat_count];
				}else{
					$status =  'Unassigned';
				}
				if($section == $section_emp && $emp_status == $status){
					$crossmatched = array($result[$i]);
					array_push($return_value, $crossmatched);
				}
			}
		}
		if($emp_status == 'All' && $section == 'All'){
			$final_data = $result;
		}else{
			$final_data = $return_value;
		}
		//end of data manipulation

		//start of generating report
		if($emp_status == 'All' && $section == 'All'){
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			// set Header
			$headerText = new PHPExcel_RichText();
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setTop(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setRight(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setLeft(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setBottom(0.25);
			$report_rows = count($header);
			for ($z = 0;$z < $report_rows;$z++)
			{
				$cell = chr(65+$z)."1";
				$header_cell = $header[$z];
				$objPHPExcel->getActiveSheet()->SetCellValue($cell, $header_cell);
			}
			$rowCount = 2;
			for($i=0;$i<count($final_data);$i++){
				if(array_key_exists('record_section',$final_data[$i])){
					if ((is_array(unserialize(base64_decode($final_data[$i]->record_section))) && count(unserialize(base64_decode($final_data[$i]->record_section))) > 0 && unserialize(base64_decode($final_data[$i]->record_section))[0] != '')) {
						$sec_count = (count(unserialize(base64_decode($final_data[$i]->record_section)))) -1;
						$section_emp =  unserialize(base64_decode($final_data[$i]->record_section))[$sec_count];
					}else{
						$section_emp =  'Unassigned';
					}
				}
				if(array_key_exists('record_status',$final_data[$i])){
					if ((is_array(unserialize(base64_decode($final_data[$i]->record_status))) && count(unserialize(base64_decode($final_data[$i]->record_status))) > 0 && unserialize(base64_decode($final_data[$i]->record_status))[0] != '')) {
						$stat_count = (count(unserialize(base64_decode($final_data[$i]->record_status)))) -1;
						$status_emp =  unserialize(base64_decode($final_data[$i]->record_status))[$stat_count];
					}else{
						$status_emp =  'Unassigned';
					}
				}
				for($a=0;$a<count($req_fields);$a++){
					$objPHPExcel->getActiveSheet()->SetCellValue('A'. $rowCount,$final_data[$i]->employee_code);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'. $rowCount,$final_data[$i]->emp_wname);
					for ($z = 0;$z < ($report_rows-2);$z++)
					{
						$arr_field = $req_fields[$z];
						$cell = chr(67+$z);
						if($final_data[$i]->$arr_field == null){
							$data = '';
						}else{
							$data = $final_data[$i]->$arr_field;
						}
						$objPHPExcel->getActiveSheet()->SetCellValue($cell. $rowCount,$data);
					}
				}
				$rowCount++;
			}
			$filename = $report_title."-".date('F_d,Y').".xls";
			$objPHPExcel->getActiveSheet()->setTitle($report_title);
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');
		}else{
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			// set Header
			$headerText = new PHPExcel_RichText();
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setTop(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setRight(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setLeft(0.25);
			$objPHPExcel->getActiveSheet()
				->getPageMargins()->setBottom(0.25);
			$report_rows = count($header);
			for ($z = 0;$z < $report_rows;$z++)
			{
				$cell = chr(65+$z)."1";
				$header_cell = $header[$z];
				$objPHPExcel->getActiveSheet()->SetCellValue($cell, $header_cell);
			}
			$rowCount = 2;
			for($i=0;$i<count($final_data);$i++){
				if(array_key_exists('record_section',$final_data[$i])){
					if ((is_array(unserialize(base64_decode($final_data[$i][0]['record_section']))) && count(unserialize(base64_decode($final_data[$i][0]['record_section']))) > 0 && unserialize(base64_decode($final_data[$i][0]['record_section']))[0] != '')) {
						$sec_count = (count(unserialize(base64_decode($final_data[$i][0]['record_section'])))) -1;
						$section_emp =  unserialize(base64_decode($final_data[$i][0]['record_section']))[$sec_count];
					}else{
						$section_emp =  'Unassigned';
					}
				}
				if(array_key_exists('record_status',$final_data[$i])){
					if ((is_array(unserialize(base64_decode($final_data[$i][0]['record_status']))) && count(unserialize(base64_decode($final_data[$i][0]['record_status']))) > 0 && unserialize(base64_decode($final_data[$i][0]['record_status']))[0] != '')) {
						$stat_count = (count(unserialize(base64_decode($final_data[$i][0]['record_status'])))) -1;
						$status_emp =  unserialize(base64_decode($final_data[$i][0]['record_status']))[$stat_count];
					}else{
						$status_emp =  'Unassigned';
					}
				}
				for($a=0;$a<count($req_fields);$a++){
					$objPHPExcel->getActiveSheet()->SetCellValue('A'. $rowCount,$final_data[$i][0]['employee_code']);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'. $rowCount,$final_data[$i][0]['emp_wname']);
					for ($z = 0;$z < ($report_rows-2);$z++)
					{
						$arr_field = $req_fields[$z];
						$cell = chr(67+$z);
						if($final_data[$i][0][$arr_field] == null){
							$data = '';
						}else{
							$data = $final_data[$i][0][$arr_field];
						}
						$objPHPExcel->getActiveSheet()->SetCellValue($cell. $rowCount,$data);
					}
				}
				$rowCount++;
			}
			$filename = $report_title."-".date('F_d,Y').".xls";
			$objPHPExcel->getActiveSheet()->setTitle($report_title);
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			ob_end_clean();
			$objWriter->save('php://output');
		}
	}

	public function generate_vleave_credits(){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);
		$columns = array('A','B','C','D','E','F');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);;
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Regularization Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'VL Credits');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Used Credits');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Remaining Credits');
		$leave_request = $this->rmm->get_vacation_leave_credits();
		$rowCount = 2;
		foreach ($leave_request as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['regdate']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['vlcredits']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['vlused']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['vlremain']);
			$rowCount++;
		}
		$filename = "Report Vacation Leave Credits.xls";
		$objPHPExcel->getActiveSheet()->setTitle(date('F Y'));
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}

	public function generate_leavecredit_allocation(){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);
		$columns = array('A','B','C','D','E','F');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);;
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Regularization Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Employement Status');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Credit Allocation');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Whole Month');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Add');
		$credit_allocation = $this->rmm->calculate_leave_credits_allocation();
		$rowCount = 2;
		foreach ($credit_allocation as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['regdate']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['status']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['leave_alloc']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['wh_month']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['misc']);
			$rowCount++;
		}
		$filename = "Report Leave Allocation.xls";
		$objPHPExcel->getActiveSheet()->setTitle(date('F Y'));
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}

	public function generate_leavecredit_allocation_perday(){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);
		$columns = array('A','B','C','D','E','F');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);;
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Regularization Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Employment Status');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Credit Allocation(per day)');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Credit Allocation(1st month variable)');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'First Month');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Succeeding Months');
		$credit_allocation = $this->rmm->calculate_leave_credits_allocation_perday();
		$rowCount = 2;
		foreach ($credit_allocation as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['regdate']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['status']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['leave_alloc_perday']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['leave_alloc_1mon']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['misc']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['wh_month']);
			$rowCount++;
		}
		$filename = "Report Leave Allocation.xls";
		$objPHPExcel->getActiveSheet()->setTitle(date('F Y'));
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}

	public function generate_emp_information(){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		// set Header
		$headerText = new PHPExcel_RichText();
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setTop(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setRight(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setLeft(0.25);
		$objPHPExcel->getActiveSheet()
			->getPageMargins()->setBottom(0.25);
		$columns = array('A','B','C','D','E','F','G','H');
			foreach($columns as $colRow) {
				foreach (range($colRow, $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) {
					$objPHPExcel->getActiveSheet()
							->getColumnDimension($col)
							->setAutoSize(true);;
				}
			}
		$countCol = 1;
		foreach($columns as $colRow) {
			$objPHPExcel->getActiveSheet()->getStyle($colRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		}
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Birthday');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Age');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Place of Birth');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Current Address');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Permanent Address');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Civil Status');
		$emp_info = $this->rmm->export_employee_information();
		$rowCount = 2;
		foreach ($emp_info as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['emp_wname']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['birthdate']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['age']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['birthplace']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['prese_add']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['perma_add']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['civil_stat']);
			$rowCount++;
		}
		$filename = "Report Employee Information.xls";
		$objPHPExcel->getActiveSheet()->setTitle(date('F Y'));
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		ob_end_clean();
		$objWriter->save('php://output');
	}
}
