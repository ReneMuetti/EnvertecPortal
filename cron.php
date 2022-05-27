<?php
ini_set('display_errors', 1);

include_once realpath('./includes/config.php');
include_once realpath('./includes/global.php');

$session = Portal::getModel('Envertech/Session');
$session->setUsername(Username)->setPassword(Password);

if ( $session->startEnvertechSession() ) {
    echo "Session: ok\n" . date("d.m.Y H:i:s") . "\n";
    
    //echo "\n-------------------------------------\n";
    //$apiSession = Portal::getModel('Envertech/ApiAccount_SessionUser');
    //var_dump( $apiSession->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$stationId = Portal::getModel('Envertech/StationId');
    //var_dump( $stationId->sendRequest() );
    
    //echo "\n-------------------------------------\n";
    //$gateways = Portal::getModel('Envertech/Gatways');
    //var_dump( $gateways->getGatewayList() );
    
    //echo "\n-------------------------------------\n";
    //$devices = Portal::getModel('Envertech/Devices');
    //$devices->setPhaseMode('three');
    //var_dump( $devices->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$devices = Portal::getModel('Envertech/Station');
    //var_dump( $devices->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$totalinfo = Portal::getModel('Envertech/StationInfo');
    //var_dump( $totalinfo->sendRequest() );
    
    //echo "\n-------------------------------------\n";
    //$terminalRealTime = Portal::getModel('Envertech/TerminalReal');
    //$terminalRealTime->addQueryData('STATIONID', StationID);
    //$terminalRealTime->addQueryData('STATIONID', StationID)->addQueryData('GATEWAYALIAS', '94000734')->addQueryData('SNALIAS', '20151750');
    //var_dump( $terminalRealTime->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$energyChart = Portal::getModel('Envertech/Chart_Energy');
    //$energyChart->setRequestValue('year', '2022')->setRequestValue('month', '05');
    //$energyChart->setRequestValue('year', date('Y'))->setRequestValue('month', date('m'));
    //var_dump( $energyChart->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$energyChart = Portal::getModel('Envertech/Chart_DayPower');
    //$energyChart->setDate('2022-05-24');
    //$energyChart->setDate(date('Y-m-d'));
    //var_dump( $energyChart->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$energyHistory = Portal::getModel('Envertech/Chart_History');
    //$energyHistory->setRequestValue('gateway', '94000734')->setRequestValue('inverter', '20151750')->setRequestValue('date', '2022-05-24');
    //$energyHistory->setRequestValue('gateway', '94000734')->setRequestValue('inverter', '20151750')->setRequestValue('date', date('Y-m-d'));
    //var_dump( $energyHistory->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$reportDaily = Portal::getModel('Envertech/Preview_DailyReport');
    //$reportDaily->setRequestValue('date', '2022-05-25')->setRequestValue('inverter', '20151750');
    //$reportDaily->setRequestValue('date', date('Y-m-d'))->setRequestValue('inverter', '20151750');
    //var_dump( $reportDaily->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$reportMonth = Portal::getModel('Envertech/Preview_MonthReport');
    //$reportMonth->setDate('2022-05');
    //$reportMonth->setDate(date('Y-m'));
    //var_dump( $reportMonth->sendRequest() );

    //echo "\n-------------------------------------\n";
    //$reportYear = Portal::getModel('Envertech/Preview_YearReport');
    //$reportYear->setYear('2022');
    //$reportYear->setYear(date('Y'));
    //var_dump( $reportYear->sendRequest() );


    echo "\n-------------------------------------\n";
    echo "Ready";
}
else {
    echo 'Session failed';
}
