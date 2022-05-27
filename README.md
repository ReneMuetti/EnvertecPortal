# EnvertecPortal
Retrieve data of a PV plant from the EnvertecPortal and store locally

/ApiStations/GetWayCount<br/>
Model: Envertech/Gatways<br/>
Bemerkung: Anzeige alle hinterlegten Gayways
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->GATEWAYNS | Empfang | 8 Stellen) |

/ApiStations/GetDevices<br/>
Model: Envertech/Devices<br/>
Bemerkung: Abfrage der Wechselrichter eines 1-Phasen-Systems
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->GatewaySN | Empfang | 8 Stellen |
| Data->GatewayAlias | Empfang | Alias für Gateway |
| Data->Invs | Empfang | Object mit Wechselrichter-Informationen |
| Data->Invs->SN | Empfang | Serial des Wechselrichter |
| Data->Invs->Alias | Empfang | Alias des Wechselrichter |

/ApiStations/GetDevicesABC<br/>
Model: Envertech/Devices<br/>
Bemerkung: Abfrage der Wechselrichter eines 3-Phasen-Systems
| Parameter | Richtung | single | three |
| --- | --- | --- |
| setPhaseMode | Model | 32 Stellen |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->GATEWAYNS | Empfang | 8 Stellen) |
| Data->InvsAA | Empfang | Object |
| Data->InvsAA->SN | Empfang | Serial des Wechselrichter |
| Data->InvsAA->Alias | Empfang | Alias des Wechselrichter |
| Data->InvsBB | Empfang | Object |
| Data->InvsBB->SN | Empfang | Serial des Wechselrichter |
| Data->InvsBB->Alias | Empfang | Alias des Wechselrichter |
| Data->InvsCC | Empfang | Object |
| Data->InvsCC->SN | Empfang | Serial des Wechselrichter |
| Data->InvsCC->Alias | Empfang | Alias des Wechselrichter |

/ApiStations/GetSunNavStationList<br/>
Model: Envertech/Station<br/>
Bemerkung: Bezeichner der eingetragenen Stations-Listen (nur für Envertec-Portal)
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->Key | Empfang | Bezeichner der Station |
| Data->Val | Empfang | ID der Station |
| Data->Selected | Empfang | Ist die Station gerade aktiv |

/ApiStations/getStationInfo<br/>
Model: Envertech/StationInfo<br/>
Bemerkung: Ermittelt alle aktuellen Daten der gewählten Station
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->UnitCapacity | Empfang | Kapazität des aktuellen Wechselrichters |
| Data->UnitEToday | Empfang | Einspeisung heutige (in KWh) |
| Data->UnitEMonth | Empfang | Einspeisung laufender Monat (in KWh) |
| Data->UnitEYear | Empfang | Einspeisung laufendes Jahr (in KWh) |
| Data->UnitETotal | Empfang | Gesamte aufgezeichntete Produktion (in KWh) |
| Data->Power | Empfang | aktuell erzeugte Leistung (in Watt) |
| Data->PowerStr | Empfang | Data->Power mit Einheit |
| Data->Capacity | Empfang | maximale Leistung |
| Data->StrCO2 | Empfang | Eingesparte CO2-Menge (in Tonnen) |
| Data->StrTrees | Empfang | Errechneter Wert für gepflanzte Bäume |
| Data->StrIncome | Empfang | Errechnete Einspeisevergütung |
| Data->PwImg | Empfang | Bild-Datei |
| Data->StationName | Empfang | Name der Station |
| Data->Lat | Empfang | GEO-Koordinaten |
| Data->Lng | Empfang | GEO-Koordinaten |
| Data->TimeZone | Empfang | Zeitzohnenverschiebung |
| Data->StrPeakPower | Empfang | höchster erzeugter Leistungswert (mit Einheit) |
| Data->Installer | Empfang | NULL |
| Data->CreateTime | Empfang | Datum der Account-Erstellung mit Zeitzohnenverschiebung |
| Data->CreateYear | Empfang | Jahr der Account-Erstellung |
| Data->CreateMonth | Empfang | Monat der Account-Erstellung |
| Data->Etoday | Empfang |  |
| Data->InvTotal | Empfang | Gesamtanzahl aller Wechselrichter |