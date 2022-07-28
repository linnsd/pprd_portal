@php 
	$mm_num = ['၀','၁', '၂', '၃', '၄', '၅', '၆','၇','၈','၉'];
	$en_num = range(0, 9);
	$tableArr = json_decode($dataArr);
	$shoptotal =0;
	$cartotal = 0;

	foreach ($tableArr as $key => $value) {
	    $shoptotal =$shoptotal + $value->shopcount;
	    $cartotal = $cartotal + $value->carcount;
	}
@endphp
document.writeln('<table>');
		document.writeln('<thead>');
			document.writeln('<tr>');
				document.writeln('<th>စဉ်</th>');
				document.writeln('<th>တိုင်းဒေသကြီး/ပြည်နယ်</th>');
				document.writeln('<th>အရောင်းဆိုင်ပေါင်း</th>');
				document.writeln('<th>ဆီသယ်ယာဥ်များ</th>');
			document.writeln('</tr>');
		document.writeln('</thead>');
		document.writeln('<tbody>');
			@foreach($tableArr as $i=>$tblarr)
			document.writeln('<tr>');
				document.writeln('<td style="padding: 10px; !important;">{{ str_replace($en_num, $mm_num, ++$i) }}</td>');
				document.writeln('<td style="padding: 10px; !important;">{{$tblarr->name }}</td>');
				document.writeln('<td style="padding: 10px; !important;">{{str_replace($en_num, $mm_num,$tblarr->shopcount)}}</td>');
				document.writeln('<td style="padding: 10px; !important;">{{str_replace($en_num, $mm_num,$tblarr->carcount)}}</td>');
			document.writeln('</tr>');
			@endforeach
			
			document.writeln('<tr>');
				document.writeln('<td style="padding: 10px; !important;"></td>');
				document.writeln('<td style="padding: 10px; !important;">စုစုပေါင်း</td>');
				document.writeln('<td style="padding: 10px; !important;">{{ str_replace($en_num, $mm_num, $shoptotal) }}</td>');
				document.writeln('<td style="padding: 10px; !important;">{{ str_replace($en_num, $mm_num, $cartotal) }}</td>');
			document.writeln('</tr>');
		document.writeln('</tbody>');
	document.writeln('</table>');