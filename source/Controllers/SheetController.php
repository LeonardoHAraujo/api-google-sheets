<?php

namespace Source\Controllers;

use Google\Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;

class SheetController {

    public static function saveData(Array $data)
    {
        $client = new Client();
        $client->setApplicationName('Google Sheets and PHP');
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(dirname(__DIR__, 2) .'/credentials.json');

        $service = new Google_Service_Sheets($client);
        $spreadsheetId = "1Ef-Q1-zb4X5e72ndnplWojKEBNZQfTeeq3XvevL7_fo";

        $range = "testePHP";

        $values = [
            [ $data['company_name'], $data['reason_social'], $data['person_name'], $data['person_email'], 
            $data['company_cnpj'], $data['person_office'], $data['person_sector'], $data['dpo_name'], $data['dpo_email'],
            $data['dpo_telephone'], $data['aware_lgpd_N13709'], $data['aware_project_grip_lgpd'], $data['share_data_folks'],
            $data['contract_share_receive_data'], $data['company_privacy_policy'], $data['company_security_policy'],
            $data['appointed_the_dpo'], $data['confidentiality_term'], $data['action_plan_security'] ]
        ];

        $body = new Google_Service_Sheets_ValueRange(['values' => $values]);
        $params = ['valueInputOption' => 'RAW'];
        $insert = ["insertDataOption" => "INSERT_ROWS"];

        $service->spreadsheets_values->append(
            $spreadsheetId,
            $range,
            $body,
            $params,
            $insert
        );
    }

}