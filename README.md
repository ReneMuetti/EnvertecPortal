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

/ApiStations/GetEnergyChartData<br/>
Model: Envertech/Chart_Energy<br/>
Bemerkung: Datenhistory für einen Monat innerhalb eines Jahres
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Model | 32 Stellen (Pflicht) |
| year | Model | 4 Stellen (Pflicht) |
| month | Model | 2 Stellen (Pflicht) |
| chartType | Model | Anzeige-Modus |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object/array |
| Data->xAxis | Empfang | Datumsangabe |
| Data->yAxis | Empfang | Tagesenergie (kWh ohne Einheit) |

/ApiStations/GetDayPowerChartDate<br/>
Model: Envertech/Chart_DayPower<br/>
Bemerkung: Datenhistory für einen speziellen Tag im Monat innerhalb eines Jahres (Datenflow alle 5 Minunten)
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Model | 32 Stellen (Pflicht) |
| date | Model | 10 Stellen (Pflicht) |
| chartType | Model | Anzeige-Modus |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object/array |
| Data->DateTime | Empfang | Datum-Zait-Angabe (ohne Zeitzohnenverschiebung) |
| Data->yAxis | Empfang | produzierte Energie (kWh ohne Einheit) |

/ApiStations/GetHistoryChartData<br/>
Model: Envertech/Chart_History<br/>
Bemerkung: Datenhistory für einen speziellen Tag im Monat innerhalb eines Jahres (Datenflow alle 3 Minunten)
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Model | 32 Stellen (Pflicht) |
| date | Model | 10 Stellen (Pflicht) |
| gatewaySN | Model | 8 Stellen (Pflicht) |
| sn | Model | 8 Stellen (Pflicht) |
| date | Model | 10 Stellen (Pflicht) |
| dateType | Model | History-Typ (Pflicht) |
| field | Model | Datenfeld innerhalb des Portal |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object/array |
| Data->powers | Empfang | array mit Energie-Angaben eines Zeitstempels (ohne Einheit) |
| Data->frequency | Empfang | array mit Netzfreqzenzen eines Zeitstempels (ohne Einheit) |
| Data->energy | Empfang | array mit Energieproduktion eines Zeitstempels (ohne Einheit) |
| Data->temperature | Empfang | array mit Themperatur-Angaben eines Zeitstempels (ohne Einheit) |
| Data->dcvoltage | Empfang | array mit DC-Eingang-Spannung eines Zeitstempels (ohne Einheit) |
| Data->acvoltage | Empfang | array mit AC Ausgang-Spannung eines Zeitstempels (ohne Einheit) |
| Data->sitetime | Empfang | array mit Zeitstempeln |

/ApiReport/PreviewDailyReport<br/>
Model: Envertech/Preview_DailyReport<br/>
Bemerkung: Datenübersicht für einen speziellen Tag im Monat innerhalb eines Jahres (Datenflow alle 2 Minunten)
Hinweis: Der ApiReport ist sehr instabil, was die Session angeht; Eventuell Session vorher löschen (nicht für periodische Abfragen geeignet)
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Model | 32 Stellen (Pflicht) |
| date | Model | 10 Stellen (Pflicht) |
| sn | Model | 8 Stellen (Pflicht) |
| field | Model | Datenfeld innerhalb des Portal |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object/array |
| Data->StationName | Empfang | Name der Station |
| Data->EToday | Empfang | Tages-Energieproduktion (ohne Einheit) |
| Data->ETotal | Empfang | Gesammt-Energieproduktion (ohne Einheit) |
| Data->Capacity | Empfang | Kapazität der Wechselrichter |
| Data->Date | Empfang | Datumsangabe |
| Data->ListSN | Empfang | Object |
| Data->ListSN->SN | Empfang | 8 Stellen |
| Data->ListSN->PV | Empfang | DC Eingang-Spannung zu diesem Zeitstempel (ohne Einheit) |
| Data->ListSN->Vac | Empfang | AC Ausgang-Spannung zu diesem Zeitstempel (ohne Einheit) |
| Data->ListSN->Power | Empfang | produzierte Leistung zu diesem Zeitstempel (ohne Einheit) |
| Data->ListSN->Frq | Empfang |  Netzfreqzenzen zu diesem Zeitstempel (ohne Einheit) |
| Data->ListSN->Temperature | Empfang | Themperatur-Angaben zu diesem Zeitstempel (ohne Einheit) |
| Data->ListSN->UpdateTime | Empfang | Datum-Zeit-Angabe |
| Data->ListSN->ETotal | Empfang | Gesamt-Produktion zu diesem Zeitstempel (ohne Einheit) |

/ApiReport/PreviewMonthReport
Model: Envertech/Preview_MonthReport<br/>
Bemerkung: Datenübersicht für einen speziellen Monat innerhalb eines Jahres
Hinweis: Der ApiReport ist sehr instabil, was die Session angeht; Eventuell Session vorher löschen (nicht für periodische Abfragen geeignet)
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Model | 32 Stellen (Pflicht) |
| date | Model | 7 Stellen (Pflicht) |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object/array |
| Data->StationName | Empfang | Name der Station |
| Data->EMonth | Empfang | Monats-Energieproduktion (ohne Einheit) |
| Data->ETotal | Empfang | Gesammt-Energieproduktion (ohne Einheit) |
| Data->Capacity | Empfang | Kapazität der Wechselrichter |
| Data->Date | Empfang | Datumsangabe |
| Data->ListItem | Empfang | Object |
| Data->ListItem->DateTime | Empfang | Datum-Angabe |
| Data->ListItem->Energy | Empfang |  produzierte Leistungs (ohne Einheit) |


/ApiReport/PreviewYearReport
Model: Envertech/Preview_YearReport<br/>
Bemerkung: Datenübersicht für einen spezielles Jahr
Hinweis: Der ApiReport ist sehr instabil, was die Session angeht; Eventuell Session vorher löschen (nicht für periodische Abfragen geeignet)
| Parameter | Richtung | Info |
| --- | --- | --- |
| stationId | Model | 32 Stellen (Pflicht) |
| date | Model | 4 Stellen (Pflicht) |
| Status | Empfang | 0: Ok; 1: Fehler |
| Result | Empfang | null |
| Data | Empfang | Object/array |
| Data->StationName | Empfang | Name der Station |
| Data->EYear | Empfang | Jahres-Energieproduktion (ohne Einheit) |
| Data->ETotal | Empfang | Gesammt-Energieproduktion (ohne Einheit) |
| Data->Capacity | Empfang | Kapazität der Wechselrichter |
| Data->Date | Empfang | Datumsangabe |
| Data->ListItem | Empfang | Object |
| Data->ListItem->DateTime | Empfang | Datum-Angabe |
| Data->ListItem->Energy | Empfang |  produzierte Leistungs (ohne Einheit) |
