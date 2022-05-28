# EnvertecPortal
Retrieve data of a PV plant from the EnvertecPortal and store locally

/ApiStations/GetWayCount<br/>
Model: Envertech/Gatways<br/>
Bemerkung: Anzeige alle hinterlegten Gayways<br/>
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->GATEWAYNS | Empfang | 8 Stellen |

/ApiStations/GetDevices<br/>
Model: Envertech/Devices<br/>
Bemerkung: Abfrage der Wechselrichter eines 1-Phasen-Systems<br/>
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
Bemerkung: Abfrage der Wechselrichter eines 3-Phasen-Systems<br/>
| Parameter | Richtung | Info |
| --- | --- | --- |
| setPhaseMode | Model | single/three |
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
Bemerkung: Bezeichner der eingetragenen Stations-Listen (nur für Envertec-Portal)<br/>
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
Bemerkung: Ermittelt alle aktuellen Daten der gewählten Station<br/>
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Senden | 32 Stellen |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->UnitCapacity | Empfang | Kapazität des aktuellen Wechselrichters |
| Data->UnitEToday | Empfang | Einspeisung heute (in KWh mit Einheit) |
| Data->UnitEMonth | Empfang | Einspeisung laufender Monat (in KWh mit Einheit) |
| Data->UnitEYear | Empfang | Einspeisung laufendes Jahr (in KWh mit Einheit) |
| Data->UnitETotal | Empfang | Gesamte aufgezeichntete Produktion (in KWh mit Einheit) |
| Data->Power | Empfang | aktuell erzeugte Leistung (in Watt ohne Einheit) |
| Data->PowerStr | Empfang | Data->Power (mit Einheit) |
| Data->Capacity | Empfang | maximale Leistung (ohne Einheit) |
| Data->StrCO2 | Empfang | Eingesparte CO2-Menge (in Tonnen mit Einheit) |
| Data->StrTrees | Empfang | Errechneter Wert für gepflanzte Bäume |
| Data->StrIncome | Empfang | Errechnete Einspeisevergütung (mit Einheit) |
| Data->PwImg | Empfang | Bild-Datei |
| Data->StationName | Empfang | Name der Station |
| Data->Lat | Empfang | GEO-Koordinaten |
| Data->Lng | Empfang | GEO-Koordinaten |
| Data->TimeZone | Empfang | Zeitzohnenverschiebung |
| Data->StrPeakPower | Empfang | höchster erzeugter Leistungswert (mit Einheit) |
| Data->Installer | Empfang | NULL |
| Data->CreateTime | Empfang | Datum der Account-Erstellung (mit Zeitzohnenverschiebung) |
| Data->CreateYear | Empfang | Jahr der Account-Erstellung |
| Data->CreateMonth | Empfang | Monat der Account-Erstellung |
| Data->Etoday | Empfang | heitige Energieproduktion (ohne Einheit) |
| Data->InvTotal | Empfang | Gesamtanzahl aller Wechselrichter |

/ApiInverters/QueryTerminalReal<br/>
Model: Envertech/TerminalReal<br/>
Bemerkung: Echtzeitabfrage der aktuellen Energiedaten (alle Parameter werden HTML-Encodet gesendet)
| Parameter | Richtung | Info |
| --- | --- | --- |
| STATIONID | Model | 32 Stellen (Pflicht) |
| GATEWAYALIAS | Model | 8 Stellen (Optional) |
| SNALIAS | Model | 8 Stellen (Optional) |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object |
| Data->PageNumber | Empfang | Seitenzahl (bei vielen Einträgen) |
| Data->PerPage | Empfang | Anzahl der Einträge je Seite |
| Data->TotalPage | Empfang | Gesamtanzahl aller Seiten |
| Data->Lan | Empfang | Sprache / Codierung |
| Data->QueryResults | Empfang | Array mit Daten für alle Phasen / Gateways |
| Data->QueryResults->GATEWAYALIAS | Empfang | Alias für Gateway |
| Data->QueryResults->GATEWAYSN | Empfang | 8 Stellen |
| Data->QueryResults->SNALIAS | Empfang | Alias für Wechselrichter |
| Data->QueryResults->SN | Empfang | 8 Stellen |
| Data->QueryResults->DCVOLTAGE | Empfang | DC-Eingang :: Spannung (V ohne Einheit) |
| Data->QueryResults->ACVOLTAGE | Empfang | AC Ausgang :: Spannung (V ohne Einheit) |
| Data->QueryResults->ACCURRENCY | Empfang |  |
| Data->QueryResults->POWER | Empfang | AC Ausgang :: erzeugte Leistung (in Watt ohne Einheit) |
| Data->QueryResults->FREQUENCY | Empfang | AC Ausgang :: ktuelle Netzfrequenz (ohne Einheit) |
| Data->QueryResults->DAYENERGY | Empfang | Einspeisung heutige (kWh ohne Einheit) |
| Data->QueryResults->ENERGY | Empfang | Gesamtenergie (kWh ohne Einheit) |
| Data->QueryResults->TEMPERATURE | Empfang | Temperatur (°C ohne Einheit) |
| Data->QueryResults->SITETIME | Empfang | Zeitstempel der letzten Aktualisierung (AM/PM ohne Zeitzohnenverschiebung) |
| Data->QueryResults->STATIONID | Empfang |  |
| Data->QueryResults->STATUS | Empfang | Fehlercode (0 = Online) |
| Data->QueryResults->SNID | Empfang | Wechselrichter-ID |
