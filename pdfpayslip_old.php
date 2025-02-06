<?php
include 'include/init.php';
include_once 'dbcon/DBConnection.php';

$dbobj = new DBConnection();
$dbobj->connect();
set_time_limit(0);

$arollid=$_REQUEST["arollid"];
$forceno=$_REQUEST["forceno"];

//$arollid=34;
//$forceno=3209;

$session_forceno = $_SESSION["forceno"];
if($session_forceno != $forceno)
	return;


$salinfoarray = $dbobj->getArollInfo($arollid);

$salinfo = $salinfoarray[0];

$saldata = $dbobj->getEmployeeSalary($arollid,$forceno);
//$month="JANUARY 2015";
$ctr=0;
$tot=ceil(count($saldata)/4);
$page=1;
//$salinfo->month_yr;


//$signature="E<br/>R<br/>U<br/>T X<br/>A O<br/>N B<br/>G<br/>I<br/>S<br/>";
$signature="SIGNATURE";
$basic_pay=$sda=$hra=$qa1=$gpf_dcps=$cghs=$ls_a=$gross_pay=$rps=$reg_ped=$special_pay=$tpt_all=$cea=$qa2=$gpf_arr=$itx=$con=$r055=$deduction1=$pro_tax=$edu_fund=$grade_pay=$tpt_arr=$ration=$qa3=$hrr=$cess_p=$hbl=$cwf=$ctd=$personal_pay=$training=$wa=$qa4=$pli=$cess_s=$fes=$r255=$net_salary=$csf=$relief=$dep_pay=$npa=$da_arr=$wc=$gis=$n_adv=$sum_gpais=$other=$paid_salary=$da=$fpa=$rm_arr=$dep_arr=$fan=$gis_arr=$l_fee=$gia=$ma=$sumptory=$sca=$nca=$cya=$ins=$rm_recovery=$ndrf_cwf=$ca=$pga_arr=$other_all=$pca=$pay_a=$comp_a=0;
$gpais=0;
$html='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" ;  />';
$html.='<style>
body{font-family: Calibri,Arial,sans-serif; font-size: 11px; font-style: normal;}
.totwidth{width:19cm;}
table, th, td {  border: 1px solid black;border-collapse: collapse; vertical-align:center;}
td{padding-left:15px;height:11px;}
@page{margin: 0.1in 0.5in 0.5in 0.1in;}
.pr{text-align:right;padding-right:30px;padding-bottom:0}
.pl{text-align:left; padding-left:15px; border:1px solid;line-height:12px;font-size: 12px;}
.pl2{text-align:left;padding-left:15px;padding-top:-1;padding-bottom:0;border:1px solid;border-top:2px solid; font-size: 14px; font-weight:bold;}
.tdclass
 {font-family: Calibri,Arial,sans-serif; border:1px solid; text-align:left;vertical-align: middle; font-size: 12px;font-weight:bold;line-height:12px;}
 
</style><body>';
foreach($saldata as $key=>$val){
	$s=$val;
	$basic_pay +=$s->basic_pay;	$sda +=$s->sda;	$hra +=$s->hra;	$qa1 +=$s->qa1;	$gpf_dcps +=$s->gpf_dcps; $cghs +=$s->cghs;	$ls_a +=$s->ls_a; $gross_pay +=$s->grade_pay; $rps +=$s->rps; $reg_ped +=$s->reg_ped; $special_pay +=$s->special_pay; $tpt_all +=$s->tpt_all; $cea +=$s->cea; $qa2 +=$s->qa2; $gpf_arr +=$s->gpf_arr; $itx +=$s->itx; $con +=$s->con; $r055 +=$s->r055; $deduction1 +=$s->deduction1; $pro_tax +=$s->pro_tax; $edu_fund +=$s->edu_fund; $grade_pay +=$s->grade_pay; $tpt_arr +=$s->tpt_arr;	$ration +=$s->ration; $qa3 +=$s->qa3; $hrr +=$s->hrr; $cess_p +=$s->cess_p; $hbl +=$s->hbl; $cwf +=$s->cwf; $ctd +=$s->ctd; $personal_pay +=$s->personal_pay; $training +=$s->training; $wa +=$s->wa; $qa4 +=$s->qa4; $pli +=$s->pli; $cess_s +=$s->cess_s; $fes +=$s->fes; $r255 +=$s->r255; $net_salary +=$s->net_salary; $csf +=$s->csf; $relief +=$s->relief; $dep_pay +=$s->dep_pay; $npa +=$s->npa; $da_arr +=$s->da_arr; $wc +=$s->wc; $gis +=$s->gis; $n_adv +=$s->n_adv; $sum_gpais +=$gpais; $other +=$s->other; $paid_salary +=$s->paid_salary; $da +=$s->da; $fpa +=$s->fpa; $rm_arr +=$s->rm_arr; $dep_arr +=$s->dep_arr; $fan +=$s->fan; $gis_arr +=$s->gis_arr; $l_fee +=$s->l_fee; $gia +=$s->gia; $ma +=$s->ma; $sumptory +=$s->sumptory; $sca +=$s->sca; $nca +=$s->nca; $cya +=$s->cya; $ins +=$s->ins; $rm_recovery +=$s->rm_recovery; $ndrf_cwf +=$s->ndrf_cwf; $ca +=$s->ca; $pga_arr +=$s->pga_arr; $other_all +=$s->other_all; $pca +=$s->pca; $pay_a +=$s->pay_a; $comp_a +=$s->comp_a;
	
	$imagepath = "../".$s->image;

	$msg = $dbobj->getMonthMessage($s->forceno, $salinfo->month_yr);
	$html.='<div class="totwidth;">
		<table style="width:100%;border:0pt;">
			<tr height="2px">
				<td width="2cm" valign="middle" align="center" style="border:0pt; padding-top:0px;"><img style="width:1.8cm;height:auto" src="../images/icon/favicon-114.png" /></td>
				<td align="center" style="border:0pt; padding-top:30px;"><span style="font-size:22px">HQ 10TH BN NATIONAL DISASTER RESPONSE FORCE</span><br><span style="font-size:16px">PAY SLIP FOR '.$salinfo->month_yr.'</span></td>
				<td width="2.2cm" height="auto" style="padding:0px;border:0pt; padding-top:0px;" ><img style="width:2.2cm;height:auto" src='.$imagepath.' /> &nbsp;</td>
			</tr>
		</table>
	
	</div><div style="clear:both" class="totwidth"><hr style="width:100%"></div>
	<div class="totwidth" style="margin-top:.4cm;">
		<table style="width:100%;" >
		
			<tr>
				<td class="tdclass" width="3cm">IRLA NO</td><td class="tdclass" width="5px">:</td><td class="tdclass" width="5cm">'.$s->forceno.'</td><td width="3cm" class="tdclass">UNIT/ OFFICE</td><td width="5px" class="tdclass">:</td><td style="font-weight:bold;" class="tdclass">10 - BN NDRF</td>
			</tr>
			<tr>
				<td class="tdclass">Name</td><td class="tdclass">:</td><td class="tdclass">'.strtoupper($s->name).'</td><td class="tdclass">ATTACHED TO</td><td class="tdclass">:</td><td style="font-weight:bold;" class="tdclass">&nbsp;</td>
			</tr>
			<tr>
				<td class="tdclass">DESIGNATION</td><td class="tdclass">:</td><td class="tdclass">'.$s->rank.'</td><td class="tdclass">GPF /DCPS_No</td><td class="tdclass">:</td><td style="font-weight:bold;" class="tdclass">'.strtoupper($s->gpf_ac).'</td>
			</tr>
			<tr>
				<td class="tdclass">BANK ACCOUNT NO</td><td class="tdclass">:</td><td class="tdclass">'.$s->bank_ac.'</td><td class="tdclass">AG OFFICE</td><td class="tdclass">:</td><td style="font-weight:bold;" class="tdclass">&nbsp;</td>
			</tr>
			<tr>
				<td class="tdclass">BANK CODE</td><td class="tdclass">:</td><td class="tdclass">&nbsp;</td>
				<td class="tdclass">PAN CARD NO</td><td class="tdclass">:</td><td style="font-weight:bold;" class="tdclass">'.$s->pan.'</td>
			</tr>
			<tr>
				<td class="tdclass">BANKER</td><td class="tdclass">:</td><td colspan="4" class="tdclass">'.$s->bank_branch.'</td>
			</tr>
			
		</table>
	</div>';

/* SIR THESE ARE NOT USED AND FEW COLUMNS ARE BLANK. I COULD NOT FIGURE OUT.
$s->ls_a	$s->reg_ped		$s->hbl		$s->ctd			$s->wa		
$s->csf		$s->relief		$s->wc		$s->gis			$s->n_adv			$s->other		$s->paid_salary			$s->mobile	$s->rm_arr
$s->fan		$s->l_fee		$s->bs_no	$s->sca			$s->nca				$s->cya			$s->rm_recovery			$s->pca		$s->pay_a
$s->comp_a
*/
				
//cwf and ndrf(cwf)	//
//$gpais=$s->gross_pay - $s->deduction1 ;  //- $s->iti; UNCOMMENT after ITI update	
//house rent=hrr

$html.='<div class="totwidth">
		<table style="width:100%" cellspacing="0" cellpadding="0">
			<tr style="border:2px solid;">
				<td width="1.1cm" class="pl2"> Sl No</td><td style="3cm" class="pl2">ALLOWANCES</td><td width="2cm" class="pl2">RUPEES</td><td width="3cm" class="pl2">DEDUCTIONS1</td><td width="2cm" class="pl2">RUPEES</td><td width="3cm" class="pl2">DEDUCTIONS2</td><td width="2cm" class="pl2">RUPEES</td></tr>
			
			<tr>
			<td class="pl">1</td> <td class="pl">Basic Pay</td><td class="pr">'.$s->basic_pay.'</td>			
			<td class="pl">GPF/DCPS </td><td class="pr">'.$s->gpf_dcps.'</td>  
			<td class="pl">RPS</td><td class="pr">'.$s->rps.'</td>
			</tr>
			
			<tr>
			<td class="pl">2</td> <td class="pl">Special Pay</td><td class="pr">'.$s->special_pay.'</td>			
			<td class="pl">GPF Arr</td><td class="pr">'.$s->gpf_arr.'</td>
			<td class="pl">PROF / TAX</td><td class="pr">'.$s->pro_tax.'</td>
			</tr>
			<tr>
			<td class="pl">3</td> <td class="pl">Grade Pay</td><td class="pr">'.$s->grade_pay.'</td>	
			<td class="pl">GPF Adv</td><td class="pr">'.$s->gpf_adv.'</td>
			<td class="pl">CWF</td><td class="pr">'.$s->cwf.'</td>
			</tr>
			
			<tr>
			<td class="pl">4</td> <td class="pl">Personal Pay</td><td class="pr">'.$s->personal_pay.'</td>		
			<td class="pl">HRR</td><td class="pr">'.$s->hrr.'</td>
			<td class="pl">CSF</td><td class="pr">'.$s->csf.'</td>
			</tr>
			
			<tr>
			<td class="pl">5</td> <td class="pl">Deputation Pay</td><td class="pr">'.$s->dep_pay.'</td>					
			<td class="pl">PLI</td><td class="pr">'.$s->pli. '</td>
			<td class="pl">OTH/INS/LIC</td><td class="pr">'.$s->other.'</td>
			</tr>
			<tr>
			<td class="pl">6</td> <td class="pl">D.A</td><td class="pr">'.$s->da.'</td>							
			<td class="pl">ITX</td><td class="pr">'.$s->itx.'</td>
			<td class="pl">GIA</td><td class="pr">'.$s->gia.'</td>
			</tr>
			
			<tr>
			<td class="pl">7</td> <td class="pl">M.A</td><td class="pr">'.$s->ma.'</td>				
			<td class="pl">CESS P</td><td class="pr">'.$s->cess_p.'</td>
			<td class="pl">NDRF WF</td><td class="pr">'.$s->ndrf_cwf.'</td>
			</tr>
			
			<tr>
			<td class="pl">8</td> <td class="pl">C.A</td><td class="pr">'.$s->ca.'</td>						
			<td class="pl">CESS S</td><td class="pr">'.$s->cess_s.'</td>
			<td class="pl">REG/RED</td><td class="pr">'.$s->reg_ped.'</td>
			</tr>
			<tr>
			<td class="pl">9</td> <td class="pl">TPT All</td><td class="pr">'.$s->tpt_all.'</td>				
			<td class="pl">CGHS</td><td class="pr">'.$s->cghs.'</td>
			<td class="pl">EDU/FUND </td><td class="pr">'.$s->edu_fund.'</td>
			</tr>
			
			<tr>
			<td class="pl">10</td><td class="pl">TPT Arr</td><td class="pr">'.$s->tpt_arr.'</td>					
			<td class="pl">GIS</td><td class="pr">'.$s->gis.'</td>
			<td class="pl">PM RELIEF</td><td class="pr">'.$s->relief.'</td>
			</tr>
			
			<tr>
			<td class="pl">11</td><td class="pl">Training</td><td class="pr">'.$s->training.'</td>					
			<td class="pl">GIS Arr</td><td class="pr">'.$s->gis_arr.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">12</td><td class="pl">NPA</td><td class="pr">'.$s->npa.'</td>						
			<td class="pl">INS</td><td class="pr">'.$s->ins.'</td>
			<td class="pl">DEDUCTIONS2</td><td class="pr">Rs   '.$s->deduction2.'</td>
			</tr>
			
			<tr>
			<td class="pl">13</td><td class="pl">FPA</td><td class="pr">'.$s->fpa.'</td>		
			<td class="pl">PAY ADV</td><td class="pr">'.$s->pay_a.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">14</td><td class="pl">HRA</td><td class="pr">'.$s->hra.'</td>			
			<td class="pl">HBA(P)</td><td class="pr">'.$s->con.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">15</td><td class="pl">CEA</td><td class="pr">'.$s->cea.'</td>		
			<td class="pl">HBA(I)</td><td class="pr">'.$s->hbl.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">16</td><td class="pl">Ration All</td><td class="pr">'.$s->ration.'</td>				
			<td class="pl">FES ADV</td><td class="pr">'.$s->fes.'</td><td class="pl">
			</td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">17</td><td class="pl">W.A</td><td class="pr">'.$s->wa.'</td>		
			<td class="pl">CON ADV</td><td class="pr">'.$s->n_adv.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">18</td><td class="pl">COB/Risk</td><td class="pr">'.$s->cob_risk.'</td>		
			<td class="pl">L FEE</td><td class="pr">'.$s->l_fee.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">19</td><td class="pl">RM Arr</td><td class="pr">'.$s->rm_arr.'</td>					
			<td class="pl">RM Recovery</td><td class="pr">'.$s->rm_recovery.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">20</td><td class="pl">Other All</td><td class="pr">'.$s->other_all.'</td>					
			<td class="pl">COMP A</td><td class="pr">'.$s->comp_a.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">21</td><td class="pl">OA 1</td><td class="pr">'.$s->qa1.'</td>					
			<td class="pl">LS ADV</td><td class="pr">'.$s->ls_a.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">22</td><td class="pl">OA 2</td><td class="pr">'.$s->qa2.'</td>					
			<td class="pl">R055</td><td class="pr">'.$s->r055.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">23</td><td class="pl">OA 3</td><td class="pr">'.$s->qa3.'</td>			
			<td class="pl">R255</td><td class="pr">'.$s->r255.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">24</td><td class="pl">OA 4</td><td class="pr">'.$s->qa4.'</td>			
			<td class="pl"></td><td class="pr"></td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">25</td><td class="pl">DA Arr</td><td class="pr">'.$s->da_arr.'</td>		
			<td class="pl">DEDUCTIONS1</td><td class="pr">Rs   '.$s->deduction1.'</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">26</td><td class="pl">DEP Arr</td><td class="pr">'.$s->dep_arr.'</td>			
			<td class="pl">&nbsp;</td><td>&nbsp;</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl">27</td><td class="pl">HPCA</td><td class="pr">'.$s->pca.'</td>					
			<td class="pl">&nbsp;</td><td>&nbsp;</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl"></td><td class="pl"></td><td class="pr"></td>			
			<td class="pl">&nbsp;</td><td>&nbsp;</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
			<tr>
			<td class="pl"></td><td class="pl">TOTAL</td><td class="pr">Rs   '.$s->gross_pay.'</td>				
			<td class="pl">&nbsp;</td><td>&nbsp;</td>
			<td class="pl"></td><td class="pr"></td>
			</tr>
			
						
			<tr>
			<td class="pl" colspan="7" height=20 align="left" valign="middle">REMARK:. '.$msg.' </td>
			</tr>
			<tr>
			<td class="pl" colspan="7" height=20 align="left" valign="middle">PASSED FOR AND PAY Rs. '.($s->paid_salary - $s->loan_amount).' ('.$dbobj->convertNumber123($s->paid_salary - $s->loan_amount).')</td>
			</tr>
		</table>
		<table width="100%">
			<tr>
			<td class="pl2" style="width:2cm;">TOTAL</td>
			<td class="pl2"style="width:2cm;">DEDUCTIONS1</td>
			<td class="pl2" style="width:2cm;">NET</td>
			<td class="pl2" style="width:2cm;">DEDUCTIONS2</td>
			<td class="pl2" style="width:2cm;">PAID</td>
			<td class="pl2" style="width:2cm;">LOAN</td>
			<td class="pl2" style="width:2cm;">BANKER</td>
			</tr>
			<tr>
			<td >Rs. '.$s->gross_pay.'</td>
			<td>Rs. '.$s->deduction1.'</td>
			<td >Rs. '.$s->net_salary.'</td>
			<td >Rs. '.$s->deduction2.'</td>
			<td>Rs. '.$s->paid_salary.'</td>
			<td>Rs. '.$s->loan_amount.'</td>
			<td>Rs. '.($s->paid_salary - $s->loan_amount).'</td>
			</tr>
		
		</table>
	</div>
	<div class="totwidth" style="page-break-after:always;margin-top:40px">
	<table style="border:none;width:100%">
		<tr><td WIDTH="32%" style="border:none">D.A</td><td style="border:none">HEAD CLERK</td><td style="border:none">ACCOUNT OFFICER</td></tr>
	</table>
		
	</div>';
	

}
$html.='</body></html>';		
//echo $html;
//exit;
		
$directory = "output/";
$date = date("Y_M_j_Gis");

$filename= "Payslip_IRLA".$forceno."_".$date.".pdf";

//$qry="UPDATE ".PREFIX."aroll_status set filename='$filename' where id='$arollid' ";
//echo $qry;
//echo $html;
//die();
//$res = mysql_query($qry);
//http://localhost/ndrf/admin/aroll.php

$filename = $directory.$filename;


//salary.pdf

date_default_timezone_set('Asia/Calcutta');
ini_set('memory_limit', '3000M');
//echo "::".$filename;
//echo $html;exit;
require_once("pdfclass/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->set_paper('A4','Portrait');
$dompdf->load_html($html);
$dompdf->render();ob_end_clean();
$output = $dompdf->output();
//echo "::::::::::::::::::::::";
file_put_contents($filename, $output);


header('Content-type: application/pdf');
readfile($filename);




?>
