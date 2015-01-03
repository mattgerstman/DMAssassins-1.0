<?php
function getTeam($teamNum)
{
	switch ($teamNum)
	{
		case	0	: $outputTeam = "Community Events"; break;
		case	1	: $outputTeam = "Dancer Relations"; break;
		case	2	: $outputTeam = "Entertainment"; break;
		case	3	: $outputTeam = "Family Relations"; break;
		case	4	: $outputTeam = "Finance"; break;
		case	5	: $outputTeam = "Hospitality"; break;
		case	6	: $outputTeam = "Marketing"; break;
		case	7	: $outputTeam = "Morale"; break;
		case	8	: $outputTeam = "Operations"; break;
		case	9	: $outputTeam = "Public Relations"; break;
		case	10	: $outputTeam = "Recruitment"; break;
		case	11	: $outputTeam = "Technology"; break;
		case	-1	: $outputTeam = "Admin"; break;		
	}
	return $outputTeam;
}


?>